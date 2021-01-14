<?php

namespace application\controllers;

use application\core\Controller;

class MainController extends Controller {
    public $controllmap = 'Home';


    public function indexAction() {
        $vars = [
//		    'lastgoods' => $this->model->dbSQL("row", "SELECT * FROM goods ORDER BY id DESC LIMIT 10"),
		];
        $title = 'Jeen Services';
        $pathmap = "$this->controllmap$title";
        if (!empty($_POST)) {
            $this->postContent($title, $pathmap, $vars);
        }
        $this->view->layout = 'verticalSlider';
        $this->view->render($title, $pathmap, $vars);
	}

    public function portfolioAction() {
        $vars = [
            'lastgoods' => $this->model->dbSQL("row", "SELECT * FROM goods ORDER BY id DESC LIMIT 10"),
        ];
        $title = 'Jeen Services';
        $pathmap = "$this->controllmap$title";
        if (!empty($_POST)) {
            $this->postContent($title, $pathmap, $vars);
        }
        $this->view->layout = 'portfolio';
        $this->view->render($title, $pathmap, $vars);
    }

    public function selfie_stickAction() {
        $vars = [

        ];
        $title = 'Selfie Stick';
        $pathmap = "$title";
        if (!empty($_POST)) {
            $this->postContent($title, $pathmap, $vars);
        }
        $this->view->layout = 'verticalSlider';
        $this->view->render($title, $pathmap, $vars);
    }
    public function grip_goAction() {
        $vars = [];
        $title = 'GripGo';
        $pathmap = "$title";
        if (!empty($_POST)) {
            $this->postContent($title, $pathmap, $vars);
        }
        $this->view->layout = 'verticalSlider';
        $this->view->render($title, $pathmap, $vars);
    }

    public function redirect_to_catalogAction() {
        $this->view->redirect("catalog/my_43/30/desc/time");
    }


        //  Default Layout
    public function servicesAction() {
        $vars = [];
        $title = 'Сервіси';
        $pathmap = "$title - Інформація";
        if (!empty($_POST)) {
            $this->postContent($title, $pathmap, $vars);
        }
        $this->view->render($title, $pathmap, $vars);
    }

    public function aboutAction() {
        $vars = [
            'lastgoods' => $this->model->dbSQL("row", "SELECT * FROM goods ORDER BY id DESC LIMIT 10"),
        ];
        $title = 'Головна';
        $pathmap = "$title";
        if (!empty($_POST)) {
            $this->postContent($title, $pathmap, $vars);
        }
        $this->view->render($title, $pathmap, $vars);
    }

    public function homeAction() {
        $vars = [
            'lastgoods' => $this->model->dbSQL("row", "SELECT * FROM goods ORDER BY id DESC LIMIT 10"),
        ];
        $title = 'Головна';
        $pathmap = "$title";
        if (!empty($_POST)) {
            $this->postContent($title, $pathmap, $vars);
        }
        $this->view->render($title, $pathmap, $vars);
    }

}