<?php

namespace application\controllers;

use application\core\Controller;

class KassaController extends Controller {
    public $controllmap = '';


    public function mainAction() {
        $title = 'Касса';
        $vars = [];
        $pathmap = "$this->controllmap$title";
        if (!empty($_POST)) {
            $this->postContent($title, $pathmap, $vars);
        }
        $this->view->layout = 'kassa';
        $this->view->render($title, $pathmap, $vars);
	}

}