<?php

namespace application\controllers;

use application\core\Controller;

class MediajeenController extends Controller {
    public $controllmap = 'Сервіси - ';

    public function mainAction() {
        $vars = [];
        $title = 'MediaJeen';
        $pathmap = "$this->controllmap$title";
        if (!empty($_POST)) {
            $this->postContent($title, $pathmap, $vars);
        }
        $this->view->render($title, $pathmap);
    }

    public function transporttvAction() {
        $vars = [];
        $title = 'MediaJeen - TransportTV';
        $pathmap = "$this->controllmap$title";
        if (!empty($_POST)) {
            if(isset($_POST['newAdvertisements_form'])){

                $this->view->ajaxResponse(false, array('act' => 'pushajax', 'content' => $this->view->ajaxRender($this->route['controller'].'/'.$this->route['action'], $vars), 'newurl' => $_SERVER["REQUEST_URI"], 'title' => $title, 'pathmap' => $pathmap));
            }else{
                $this->postContent($title, $pathmap, $vars);
            }
        }
        $this->view->render($title, $pathmap);
    }
    public function transportroutesAction() {
        // Validation sorting param
        if( !in_array($this->route['sorting'], array('asc', 'desc'))){
            $this->view->errorCode(404);
        }
        // Validation itemsort param
        if( $this->route['itemsort'] == 'time'){
            $itemsort = "id";
        }elseif($this->route['itemsort'] == 'userid'){
            $itemsort = "userid";
        }else{
            $this->view->errorCode(404);
        }
        // Global var
        $getrows = 'id, userid, img, route';
        $sorting = "ORDER BY $itemsort ".strtoupper($this->route['sorting']);
        $limitROUTE = 'LIMIT '.(int)$this->route['page'];

        // Param Opiton
        if ($this->route['option'] == 'all') {
            $title = "Каталог";
            $where = '';
            $params = [];
            $pathmap = "$this->controllmap$title";
        }elseif (explode("_", $this->route['option'])[0] == 'my') {
            $arrMy = explode("_", $this->route['option']);
            if(!isset($arrMy[1])){
                $this->view->errorCode(404);
            }
            $my = $arrMy[1];
            $id = $my;
            $where = 'WHERE userid = :userid';
            $params = [
                "userid" => $id,
            ];
            if($my == $_SESSION['account']['id']) {
                $title = "Мої товари";
            }else{
                $title = "Товари";
            }
            $pathmap = "$this->controllmap$title";
        }elseif ($this->route['option'] == 'search') {
            $title = "Пошук";
            $where = '';
            $params = [];
            $pathmap = "$this->controllmap$title";
        }else {
            $this->view->errorCode(404);
        }

        if(!empty($_POST)) {
            if (isset($_POST['pagination_f'])) {
                $startFrom = $_POST['startFrom'];
                $limitROUTE = 'LIMIT '.$startFrom.', 30' ;
                $vars = [
                    'list' =>  $this->model->dbSQL("row", "SELECT $getrows FROM mediaTransportRoutes $where $sorting $limitROUTE", $params),
                ];
                $htmlgoods = $this->view->ajaxRender($this->route['controller'].'/'.$this->route['action'], $vars);
                $how = count($vars['list']);

                $this->view->dataAjax($htmlgoods, $how);
            }
        }
        $vars = [
            'list' => $this->model->dbSQL("row", "SELECT $getrows FROM mediaTransportRoutes $where $sorting $limitROUTE", $params)
        ];
        $title = 'MediaJeen - TransportTV - Маршути';
        $pathmap = "$this->controllmap$title";
        if (!empty($_POST)) {
            if(isset($_POST['newAdvertisements_form'])){

                $this->view->ajaxResponse(false, array('act' => 'pushajax', 'content' => $this->view->ajaxRender($this->route['controller'].'/'.$this->route['action'], $vars), 'newurl' => $_SERVER["REQUEST_URI"], 'title' => $title, 'pathmap' => $pathmap));
            }else{
                $this->postContent($title, $pathmap, $vars);
            }
        }
        $this->view->render($title, $pathmap, $vars);
    }

    public function transportRouteAddAction() {
//        $this->model->deleteTwoProbilSql();
        function getVars($context){
            $vars = [
                'village' => $context->model->dbSQL("row", "SELECT * FROM located_village"),
                'region' => $context->model->dbSQL("KEYPAIR", "SELECT id, region FROM located_region"),
                'area' => $context->model->dbSQL("KEYPAIR", "SELECT id, area FROM located_area"),
            ];
            return $vars;
        }

        $title = 'MediaJeen - TransportTV - Додати маршут';
        $pathmap = "$this->controllmap$title";
        if (!empty($_POST)) {
            if(isset($_POST['transportRouteAdd_form'])){

                $this->view->ajaxResponse(false, array('act' => 'pushajax', 'content' => $this->view->ajaxRender($this->route['controller'].'/'.$this->route['action'], $vars), 'newurl' => $_SERVER["REQUEST_URI"], 'title' => $title, 'pathmap' => $pathmap));
            }else{
                $vars = getVars($this);
                $this->postContent($title, $pathmap, $vars);
            }
        }
        $vars = getVars($this);
//        debug($vars['area']);
        $this->view->render($title, $pathmap, $vars);
    }

    public function newAdvertisementsAction() {
        $vars = [];
        $title = 'MediaJeen - TransportTV - Запустити рекламу';
        $pathmap = "$this->controllmap$title";
        if (!empty($_POST)) {
            if(isset($_POST['newAdvertisements_form'])){

                $this->view->ajaxResponse(false, array('act' => 'pushajax', 'content' => $this->view->ajaxRender($this->route['controller'].'/'.$this->route['action'], $vars), 'newurl' => $_SERVER["REQUEST_URI"], 'title' => $title, 'pathmap' => $pathmap));
            }else{
                $this->postContent($title, $pathmap, $vars);
            }
        }
        $this->view->render($title, $pathmap);
    }

    public function viewAction() {
        $vars = [];
        $title = 'MediaJeen - TransportTV - Перегляд';
        $pathmap = "$this->controllmap$title";
        if (!empty($_POST)) {
            $this->postContent($title, $pathmap, $vars);
        }
        $this->view->render($title, $pathmap, $vars);
    }

    public function viewpayapiAction() {
        $vars = [];
        $title = 'ok';
        $pathmap = "$this->controllmap$title";
        if (!empty($_POST)) {
            $this->postContent($title, $pathmap, $vars);
        }
        $this->view->render($title, $pathmap, $vars);
    }
}