<?php

namespace application\core;

require 'application/lib/simple_html_dom.php';


class View {

	public $path;
	public $route;
	public $layout = 'default';

	public function __construct($route) {
		$this->route = $route;
		$this->path = $route['controller'].'/'.$route['action'];
	}

    public function render($title, $pathmap = "", $vars = []) {
        extract($vars);
        $part = "application/config/space.php";
        $arrLayout = require $part;
        $arrLayout = $arrLayout[$this->layout];

        ob_start();
            foreach ($arrLayout as $key => $val){
                require 'application/views/layouts/'.$this->layout.'/'.$val.'.php';
            }
            require 'application/views/content/'.$this->path.'.php';
        $contents = ob_get_clean();
        require 'application/views/layouts/'.$this->layout.'/'.$this->layout.'.php';
    }

	public function ajaxRender($thispath, $vars = []) {
        $path = 'application/views/content/'.$thispath.'.php';
        return $this->reqvar($path, $vars);
	}

    public function cropFragmentLayout($file, $vars = [] ){
        $path = 'application/views/layouts/'.$this->layout.'/'.$file.'.php';
        return $this->reqvar($path, $vars);
	}

    public function reqvar($path, $vars){
        extract($vars);
        if (file_exists($path)) {
            ob_start();
            require $path;
            $file = ob_get_clean();
            return $file;
        }else return false;
    }

	public function redirect($url) {
		header('location: /'.$url);
		exit;
	}

	static function errorCode($code) {
		http_response_code($code);
		$path = 'application/views/errors/'.$code.'.php';
		if(empty($_POST)){
            if (file_exists($path)) {
                require $path;
            }
        }else{
            if (file_exists($path)) {
                header('location: /'.$path);
                exit;
            }
        }
		exit;
	}

	public function ajaxResponse($message, $action, $method = 'swal'){
		exit(json_encode([
			'message' => $message,
			'action' => $action,
            'method' => $method
		]));
	}

	public function dataAjax($data, $max = 0) {
		exit(json_encode(['data' => $data, 'max' => $max]));
	}
}	