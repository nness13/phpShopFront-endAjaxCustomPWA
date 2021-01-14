<?php

namespace application\core;

use application\core\View;

abstract class Controller {

	public $route;
	public $view;
	public $acl;
	public $config;

	public function __construct($route) {
		$this->route = $route;
        if ( !isset($_SESSION['account']) ) {
            if(isset($_COOKIE['auth'])){
                $_SESSION['account'] = unserialize($_COOKIE['auth']);
            }
        }
		if (!$this->checkAcl()) {
			View::errorCode(403);
		}
		$this->view = new View($route);
		$this->model = $this->loadModel($route['controller']);
		    // Історія
        $data = $this->model->dbSelectFromWhere('*', 'visit_user', 'ip', $_SERVER['REMOTE_ADDR'], 'row');
        if($data){
            if(strtotime(date("Y-m-d  H:i:s", strtotime('2 hour'))) - strtotime($data[count($data) - 1]['time_v']) >= 3){
                if(strtotime(date("Y-m-d  H:i:s")) - strtotime($data[0]['time_v']) >= 14400){
                    $this->model->dbDeleteFromWhere("visit_user", "id", $data[0]['id'] );
                }
                $this->model->get_visit_info(trim($_SERVER['REQUEST_URI'], '/'));
            }
        }else{
            $this->model->get_visit_info(trim($_SERVER['REQUEST_URI'], '/'));
        }
		// if ( !in_array($_SERVER['REMOTE_ADDR'], array('37.52.70.154', '134.249.180.24')) ) {
		// 	$this->view->errorCode(504);
		// }

        if(isset($_SESSION['account']['id'])){
            $this->model->SessionUpdate();
        }
        if (!empty($_POST)) {
			if(isset($_POST['namespace'])){
				if ($_POST['namespace'] != 'specialspace1') {
					$this->view->errorCode(403);
				}
			}else{
				$this->view->errorCode(403);

			}
		}
        $this->config = require 'application/config/config.php';

    }

	public function loadModel($name) {
		$path = 'application\models\\'.ucfirst($name);
		if (class_exists($path)) {
			return new $path;
		}
	}

	public function checkAcl() {
		$this->acl = require 'application/acl/'.$this->route['controller'].'.php';
        $auth = isset($_SESSION['account']['id']);
        if ($this->isAcl('all')) {
			return true;
		}
        elseif (!$auth and $this->isAcl('guest')) {
            return true;
        }
		elseif ($auth and $this->isAcl('authorize')) {
			return true;
		}
        elseif ($auth and $_SESSION['account']['status'] == 2 and $this->isAcl('supplies')) {
            return true;
        }
		elseif ($auth and $_SESSION['account']['status'] == 3 and $this->isAcl('admin')) {
			return true;
		}
		return false;
	}

	public function isAcl($key) {
		return in_array($this->route['action'], $this->acl[$key]);
	}

	public function postContent($title, $pathmap = "", $vars = []) {
		if(isset($_POST['pushajax_f'])){
			$this->view->ajaxResponse(false, array('act' => 'pushajax', 'content' => $this->view->ajaxRender($this->route['controller'].'/'.$this->route['action'], $vars), 'newurl' => $_SERVER["REQUEST_URI"], 'title' => $title, 'pathmap' => $pathmap));
		}elseif(isset($_POST['popstate_f'])){
			$this->view->ajaxResponse(false, array('act' => 'popState', 'content' => $this->view->ajaxRender($this->route['controller'].'/'.$this->route['action'], $vars), 'title' => $title, 'pathmap' => $pathmap));
		}
	}

}