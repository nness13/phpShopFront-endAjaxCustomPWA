<?php

namespace application\controllers;

use application\core\Controller;
use application\models\Account;

class AccountController extends Controller {
    public $controllmap = 'Аккаунт - ';

	    // Реєстрація
	public function registerAction() {

		if (!empty($_POST)) {
		    if(isset($_POST['register_form'])){
                    if (!$this->model->validate(['login' => 'login', 'number' => 'number', 'password' => 'password', 'ref' => 'ref'], $_POST)) {
                        $this->view->ajaxResponse(array('text' => $this->model->error, 'type' =>'error'), false );
                    }
                    if ($this->model->dbSelectFromWhere('id', 'accounts', 'login', $_POST['login'])) {
                        $this->view->ajaxResponse(array('text' => 'Цей логін зайнятий', 'type' =>'error'), false);
                    }
                    if ($this->model->dbSelectFromWhere('id', 'accounts', 'email', $_POST['number'])) {
                        $this->view->ajaxResponse(array('text' => 'Цей номер вже зареєстрований', 'type' =>'error'), false);
                    }
                    if (!empty($_POST['ref'])) {
                        if ($_POST['login'] == $_POST['ref']) {
                            $this->view->ajaxResponse(array('text' => 'Реєстрація неможлива','type' =>'error'), false);
                        }
                        if (!$this->model->dbSelectFromWhere('id', 'accounts', 'login', $_POST['ref'])) {
                            $this->view->ajaxResponse(array('text' => 'Промо недійсний', 'type' =>'error'), false);
                        }
                    }
                    $this->model->register($_POST);
                    $data = $this->model->dbSelectFromWhere('*', 'accounts', 'login', $_POST['login'], 'row');
                    $_SESSION['account'] = $data[0];
                    setcookie('auth', serialize($data[0]), time()+366600, '/' );
                    $this->view->ajaxResponse(array('text' => 'Привіт мій друг', 'timer' => 2000, 'type' => 'success'), array('act' => 'go', 'url' => 'about' ));
               }else{
                    $this->postContent('Реєстрація');
                }
            }
        $this->view->layout = 'log-in';

		$this->view->render('Реєстрація');
	}

        // Вхід
    public function loginAction() {
        if (!empty($_POST)) {
            if(isset($_POST['auth_form'])){
                if (!$this->model->validate(['login' => 'login', 'password' => 'password'], $_POST)) {
                    $this->view->ajaxResponse(array('text' => $this->model->error, 'type' =>'error'), false);
                }
                if (!$this->model->checkData($_POST['login'], $_POST['password'])) {
                    $this->view->ajaxResponse(array('text' => 'Логін або пароль вказаний невірно', 'type' =>'error'), false);
                }
                $data = $this->model->dbSelectFromWhere('*', 'accounts', 'login', $_POST['login'], 'row');
                $_SESSION['account'] = $data[0];
                setcookie('auth', serialize($data[0]), time()+366600, '/' );
                if(isset($_POST['default'])){
                    $this->view->ajaxResponse(array('text' => 'Привіт мій друг', 'timer' => 2000, 'type' => 'success'), array('act' => 'ViewAjax', 'refreshContainer' => true, 'html' => array('.leftPanel' => $this->view->cropFragmentLayout('leftPanel'), '.topPanel' => $this->view->cropFragmentLayout('topPanel')), 'closeMenu'));
                }else{
                    $this->view->ajaxResponse(array('text' => 'Привіт мій друг', 'timer' => 2000, 'type' => 'success'), array('act' => 'go', 'url' => 'about' ));
                }
            }else{
                $this->postContent('Вхід');
            }
        }
        $this->view->layout = 'log-in';

        $this->view->render('Вхід');
    }
        //  Відновлення пароля
    public function recoveryAction() {
        if (!empty($_POST)) {
            if(isset($_POST['recovery_form'])){
                if (!$this->model->validate(['login' => 'login'], $_POST)) {
                    $this->view->ajaxResponse(array('text' => $this->model->error, 'timer' => 3000, 'type' =>'error'), false);
                }
                elseif (!$this->model->dbSelectFromWhere('id', 'accounts', 'login', $_POST['login'])) {
                    $this->view->ajaxResponse(array('text' => 'Користувач не знайдений', 'timer' => 3000, 'type' =>'error'), false);
                }
                $this->view->ajaxResponse(array('text' => 'Введіть ваш номер телефону', 'timer' => 3000, 'type' =>'success'), false);
            }else{
                $this->postContent('Відновлення пароля');
            }
        }
        $this->view->layout = 'log-in';

        $this->view->render('Відновлення пароля');
    }

        // Мій Кабінет
    public function settingsAction() {
        if (!$this->model->dbSelectFromWhere('id', 'accounts', 'id', $_SESSION['account']['id'])) {
            $this->view->errorCode(404);
        }
        function getVars($context){
            $vars = [
                'who' => $context->model->whoStatus($_SESSION['account']['status']),
                'datacleave' => $context->model->dbSelectFromWhere('*', 'cleave', 'idclient', $_SESSION['account']['id'], 'row'),
                'historyIP' => explode(',', $context->model->dbSQL("column", "SELECT historyIP FROM accounts WHERE id = ".$_SESSION['account']['id']))
            ];
            if ($_SESSION['account']['status'] == 4){
                $params = [
                    "userid" => $_SESSION['account']['id'],
                ];
                $vars['transportRoute'] = $context->model->dbSQL("row", "SELECT id, userid, img, route FROM mediaTransportRoutes WHERE userid = :userid ", $params);
            }
            if ( $_SESSION['account']['status'] == 3 ){
                $vars['visit_user'] = $context->model->dbSQL("row", "SELECT * FROM visit_user GROUP BY ip  ORDER BY id DESC");
            }
            return $vars;
        }
        $title = 'Мій кабінет';
        $pathmap = "$this->controllmap$title";
        if (!empty($_POST)) {
            if (isset($_POST['updatePassword_f'])) {
                if (!$this->model->validate(['password' => 'password'], $_POST)) {
                    $this->view->ajaxResponse(array('text' => $this->model->error, 'type' =>'error'), false);
                }
                $this->model->passwordUpdate($_POST);
                $this->view->ajaxResponse(array('text' => 'Пароль успішно змінено', 'timer' => 2000, 'type' => 'success'), false);
            }
            if (isset($_POST['updateNumber_f'])) {
                if (!$this->model->validate(['number' => 'number'], $_POST)) {
                    $this->view->ajaxResponse(array('text' => $this->model->error, 'type' =>'error'), false);
                }
                $this->model->numberUpdate($_POST);
                $this->view->ajaxResponse(array('text' => 'Номер успішно змінено', 'timer' => 2000, 'type' => 'success'), array('act' => 'ViewAjax', 'html' => array('.leftPanel' => $this->view->cropFragmentLayout('leftPanel'), '.topPanel' => $this->view->cropFragmentLayout('topPanel'))) );
            }
            if (isset($_POST['updateLogin_f'])) {
                if (!$this->model->validate(['login' => 'login'], $_POST)) {
                    $this->view->ajaxResponse(array('text' => $this->model->error, 'type' =>'error'), false);
                }
                $this->model->loginUpdate($_POST);
                $this->view->ajaxResponse(array('text' => 'Унікальне Імя змінено', 'timer' => 2000, 'type' => 'success'), array('act' => 'ViewAjax', 'html' => array('.leftPanel' => $this->view->cropFragmentLayout('leftPanel'), '.topPanel' => $this->view->cropFragmentLayout('topPanel')) ));
            }else{
                $vars = getVars($this);
                $this->postContent($title, $pathmap, $vars);
            }
        }

        $vars = getVars($this);
//        debug($vars);
        $this->view->render($title, $pathmap, $vars);
    }

    public function historyAction() {
        function getVars($context){
            if ( $_SESSION['account']['status'] == 3 ){
                $params = [
                    "id" =>  $context->route['id'],
                ];
                $ip = $context->model->dbSQL("column", "SELECT ip FROM visit_user WHERE id = :id", $params);
                $params = [
                    "ip" =>  $ip,
                ];
                $vars['visit_user'] = $context->model->dbSQL("row", "SELECT * FROM visit_user WHERE ip = :ip ORDER BY id DESC", $params);
            }
            return $vars;
        }
        $title = 'Історія користувача';
        $pathmap = "$this->controllmap$title";
        if (!empty($_POST)) {
                $vars = getVars($this);
                $this->postContent($title, $pathmap, $vars);
        }
        $vars = getVars($this);
        $this->view->render($title, $pathmap, $vars);
    }

    // Вихід
    public function logoutAction() {
        $_SESSION['account'] = 'unset';
        $this->view->redirect('catalog/all/30/desc/time');
    }

}