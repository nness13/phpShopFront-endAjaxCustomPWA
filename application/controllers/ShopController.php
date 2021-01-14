<?php

namespace application\controllers;

use application\core\Controller;

class ShopController extends Controller {
    public $controllmap = 'Магазин - ';

    public function catalogAction() {
            // Validation sorting param
        if( !in_array($this->route['sorting'], array('asc', 'desc'))){
            $this->view->errorCode(404);
        }
            // Validation itemsort param
        if( $this->route['itemsort'] == 'time'){
            $itemsort = "id";
        }elseif($this->route['itemsort'] == 'price'){
            $itemsort = "price";
        }else{
            $this->view->errorCode(404);
        }
            // Global var
        $getrows = 'id, name, price';
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
            $my = $arrMy[1];
            $id = $my;
            $where = 'WHERE diller = :diller';
            $params = [
                "diller" => $id,
            ];
            $title = "Товари";
            if(isset($_SESSION['account']['id'])){
                if($my == $_SESSION['account']['id']) {
                    $title = "Мої товари";
                }
            }
            $pathmap = "$this->controllmap$title";
        }elseif ($this->route['option'] == 'drop') {
            $where = 'WHERE dropshop = :dropshop';
            $params = [
                "dropshop" => 1,
            ];
            $title = "Дропшипінг";
            $pathmap = "$this->controllmap$title";
        }elseif (explode("_", $this->route['option'])[0] == 'cat') {
            $cat = explode("_", $this->route['option']);
            $category = $this->model->dbSelectFromWhere('*', 'category', 'id', $cat[1], 'row');
            if(!empty($category)) {
                $title = "Категорії";
                $where = 'WHERE category = :category';
                $params = [
                    "category" => $category[0]['name'],
                ];
                $pathmap = $this->controllmap.$title." - ".$category[0]['name'];
            }else {
                $this->view->errorCode(404);
            }
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
                    'list' =>  $this->model->dbSQL("row", "SELECT $getrows FROM goods $where $sorting $limitROUTE", $params),
                ];
                $htmlgoods = $this->view->ajaxRender($this->route['controller'].'/'.$this->route['action'], $vars);
                $how = count($vars['list']);

                $this->view->dataAjax($htmlgoods, $how);
            }
        }
        $vars = [
            'list' => $this->model->dbSQL("row", "SELECT $getrows FROM goods $where $sorting $limitROUTE", $params)
        ];

        if(!empty($_POST)){
            if(isset($_POST['sorting_f'])){
                $this->view->ajaxResponse(false, array('act' => 'pushajax', 'sorting' => 'catmenu', 'content' => $this->view->ajaxRender($this->route['controller'].'/'.$this->route['action'], $vars), 'newurl' => $_SERVER["REQUEST_URI"], 'title' => $title, 'pathmap' => $pathmap));
            }elseif (isset($_POST['search_f'])) {
                if(!empty($_POST['val'])){
                    if (!$this->model->validate(['val' => 'search'], $_POST)) {
                        $this->view->ajaxResponse(array('text' => $this->model->error,  'type' =>'error'), array('act' => 'clearnSearch'));
                    }
                    $val = $_POST['val'];
                    $_SESSION['search']['lastsearch'] = $val;
                    $vars = [
                        'list' => $this->model->dbSQL("row", "SELECT id, name, description, price, category FROM goods WHERE name LIKE '%$val%' OR description LIKE '%$val%' OR category LIKE '%$val%' ")
                    ];
                }
                $this->view->ajaxResponse(false, array('act' => 'pushajax', 'content' => $this->view->ajaxRender($this->route['controller'].'/'.$this->route['action'], $vars), 'newurl' => $_SERVER["REQUEST_URI"], 'title' => $title, 'pathmap' => $pathmap));
            }
            $this->postContent($title, $pathmap, $vars);
        }
        $this->view->render($title, $pathmap, $vars);
    }


    public function newGoodsAction() {
        if(!$this->model->dbSelectFromWhere('id', 'accounts', 'status', 3)){
            $this->view->errorCode(404);
        }
        $vars = [];
        $title = 'Додати товар';
        $pathmap = "$this->controllmap$title";
        if (!empty($_POST)) {
            if (isset($_POST['newCategory_f'])) {
                if (!$this->model->validate(['category' => 'namegoods'], $_POST)) {
                    $this->view->ajaxResponse(array('text' => $this->model->error, 'timer' => 3000,  'type' =>'error'), false);
                }
                if ($this->model->dbSelectFromWhere('id', 'category', 'name', $_POST['category'])) {
                    $this->view->ajaxResponse(array('text' => 'Ми боремось з спамом на нашому сервісі!', 'timer' => 3000,  'type' =>'error'), false);
                }
                $name = $this->model->categoryAdd($_POST);
                if (!$name) {
                    $this->view->ajaxResponse(array('text' => 'Помилка обробки запиту', 'timer' => 3000,  'type' =>'error'), false);
                }
                $this->view->ajaxResponse(array('text' => 'Ваша пропозиція буде розглянута протягом 24 годин', 'timer' => 3000,  'type' =>'success'), false);

            }elseif(isset($_POST['newGoods_form'])){
//                debug($_FILES['img']['tmp_name']);

                if (!isset($_POST['category'])){
                    $this->view->ajaxResponse(array('text' => 'Категорія товару є обовязковим полем!', 'type' =>'error'), false);
                }
                if (!$this->model->validate(['name' => 'namegoods', 'description' => 'description', 'category' => 'namegoods'], $_POST)) {
                    $this->view->ajaxResponse(array('text' => $this->model->error,  'type' =>'error'), false);
                }
                if (!$this->model->dbSelectFromWhere('id', 'category', 'name', $_POST['category'])){
                    $this->view->ajaxResponse(array('text' => 'Ваші дії були залоговані!',  'type' =>'error'), false);
                }
                if (empty($_FILES['img']['tmp_name'])) {
                    $this->view->ajaxResponse(array('text' => 'Зображення не вибрано',  'type' =>'error'), false);
                }
                if ($_POST['name'] == $this->model->dbSelectFromWhere('name', 'goods', 'description', $_POST['description'])) {
                    $this->view->ajaxResponse(array('text' => 'Ми боремось з спамом на нашому сервісі!',  'type' =>'error'), false);
                }
                if (!$this->model->dbSelectFromWhere('id', 'category', 'name', $_POST['category'])) {
                    $this->view->ajaxResponse(array('text' => 'Категорії не існує',  'type' =>'error'), false);
                }
//				for ($i = 1; $i <= 20; $i++) {
                    $id = $this->model->goodsAdd($_POST);
                    if (!$id) {
                        $this->view->ajaxResponse(array('text' => 'Помилка обробки запиту',  'type' =>'error'), false);
                    }
                    $this->model->goodsUploadImage($_FILES['img']['tmp_name'], $id, 0);
                    if(!empty($_FILES['imgAddit']['tmp_name'])){
                        $countAdditImg = $this->model->goodsUploadImage($_FILES['imgAddit']['tmp_name'], $id, 1, false);
                        $this->model->countAdditImg($countAdditImg, $id);
                    }
//				}
                $this->view->ajaxResponse(array('text' => 'Товар доданно', 'timer' => 3000, 'type' =>'success'), array('act' => 'contentRedirect', 'url' => "/goods/$id"));
            }else{
                $this->postContent($title, $pathmap, $vars);
            }
        }
        $this->view->render($title, $pathmap, $vars);
    }

    public function goodsAction() {
        if(!$this->model->dbSelectFromWhere('id', 'goods', 'id', $this->route['id'])){
            $this->view->errorCode(404);
        }
        $issetcleaveid = false;
        if(isset($_SESSION['account']['id'])){
            $datacleave = $this->model->dbSelectFromWhere('*', 'cleave', 'idclient', $_SESSION['account']['id'], 'row');
            foreach ($datacleave as $key => $val){
                if($val['idgoods'] == $this->route['id']){
                    $issetcleaveid = $val['id'];
                }
            }
        }

        $datagoods = $this->model->dbSelectFromWhere('*', 'goods', 'id', $this->route['id'], 'row')[0];
        if (!empty($_POST)) {
            if (isset($_POST['ordergoods_f'])) {
                if (!$this->model->validate(['howgoods' => 'number'], $_POST)) {
                    $this->view->ajaxResponse(array('text' => $this->model->error, 'timer' => 3000, 'type' =>'error'), false);
                }
                $id = $this->model->ordergoodsAdd($datagoods, $_POST);
                $this->view->ajaxResponse(array('text' => "Покупка", 'timer' => 3000, 'type' =>'success'), array('act' => 'contentRedirect', 'url' => "/payment/$id"));
            }
            elseif (isset($_POST['cleavegoods_f'])) {
                if ($issetcleaveid) {
                    $this->view->ajaxResponse(array('text' => 'Ваші дії були залоговані', 'timer' => 3000, 'type' =>'error'), false);
                }
                $idcleave = $this->model->cleavegoodsAdd($datagoods);
                if (!$idcleave) {
                    $this->view->ajaxResponse(array('text' => 'Помилка зберігання', 'timer' => 3000, 'type' =>'error'), false);
                }
                $this->view->ajaxResponse(array('text' => 'Товар добавлено у ваш кошик', 'timer' => 3000, 'type' =>'success'), array('act' => 'backHistory'));
            }
            elseif (isset($_POST['deletecleave_f'])) {
                if (!$issetcleaveid) {
                    $this->view->ajaxResponse(array('text' => 'Ваші дії були залоговані', 'timer' => 3000, 'type' =>'error'), false);
                }
                $this->model->dbDeleteFromWhere('cleave', 'id', $issetcleaveid);
                $this->view->ajaxResponse(array('text' => 'Товар видалено з кошика', 'timer' => 3000,  'type' =>'success'), array('act' => 'contentRedirect', 'url' => $_SERVER['REQUEST_URI']));
            }
        }
        $number = $this->model->dbSelectFromWhere('email', 'accounts', 'id', $datagoods['diller']);
        $vars = [
            'list' => $datagoods,
            'config' => $this->config,
            'cleave' => $issetcleaveid,
            'number' => $number
        ];
        $title = $vars['list']['name'];
        $pathmap = $this->controllmap.$datagoods['category']." - ".$title;
        if (!empty($_POST)) {
            $this->postContent($title, $pathmap, $vars);
        }
        $this->view->render($title, $pathmap, $vars);
    }

    public function editGoodsAction() {
        if(!$this->model->dbSelectFromWhere('id', 'goods', 'id', $this->route['id'])){
            $this->view->errorCode(404);
        }
        $goodsdata = $this->model->dbSelectFromWhere('*', 'goods', 'id', $this->route['id'], 'row')[0];
        if($_SESSION['account']['id'] == $goodsdata['diller'] || $_SESSION['account']['status'] == $this->config['statusAdmin']){

        }else{
            $this->view->errorCode(403);
        }
        if (!empty($_POST)) {
            if (isset($_POST['formGoodsEdit_form'])) {
                if (!$this->model->validate(['name' => 'namegoods', 'description' => 'description'], $_POST)) {
                    $this->view->ajaxResponse(array('text' => $this->model->error, 'timer' => 3000,  'type' =>'error'), array('act' => 'contentRedirect', 'url' => $_SERVER['REQUEST_URI']));
                }
                if(!empty($_FILES['0']['tmp_name'])){
                    $this->model->goodsUploadImage($_FILES['0']['tmp_name'], $goodsdata['id'], 0);
                }
                $count = 0;
                for ($i=1; $i <= 5; $i++) {
                    if(file_exists("materials/responsive/goods/".$goodsdata['id']."/$i.jpg")){
                        $count += 1;
                    }
                    if(!empty($_FILES["$i"]['tmp_name'])){
                        $this->model->goodsUploadImage($_FILES["$i"]['tmp_name'], $goodsdata['id'], $i);
                    }
                }
                $_POST['countAdditImg'] = $count;
                $this->model->editGoods($_POST, $goodsdata['id'], $goodsdata);
                $this->view->ajaxResponse(array('text' => "Зміни збережено", 'timer' => 3000, 'type' =>'success'), array('act' => 'contentRedirect', 'url' => "/goods"."/".$goodsdata['id']));
            }elseif (isset($_POST['deleteAdditImg_f'])){
                if(in_array($_POST['data'], array(1, 2, 3, 4, 5))){
                    unlink('materials/responsive/goods/'.$goodsdata['id'].'/'.$_POST['data'].'.jpg');
                    $this->view->ajaxResponse(false, array('act' => 'deleteAdditImg', 'data' => $_POST['data']));
                }
            }elseif (isset($_POST['deleteGoods_f'])) {
                $this->model->dbDeleteFromWhere('goods', 'id', $goodsdata['id']);
                $dirname = 'materials/responsive/goods/'.$goodsdata['id'];
                array_map('unlink', glob("$dirname/*.*"));
                rmdir($dirname);
                $this->view->ajaxResponse(array('title' => '','text' => 'Товар видалено', 'timer' => 3000,  'type' =>'success'), array('act' => 'backHistory'));
            }
        }
        $vars = [
            'list' => $this->model->dbSelectFromWhere('*', 'goods', 'id', $this->route['id'], 'row')[0],
        ];
        $title = $vars['list']['name'];
        $pathmap = "$this->controllmap$title";
        if (!empty($_POST)) {
            $this->postContent($title, $pathmap, $vars);
        }
        $this->view->render($title, $pathmap, $vars);
    }

}