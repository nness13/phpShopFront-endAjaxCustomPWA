<?php

namespace application\controllers;

use application\core\Controller;

class ApiController extends Controller {

	public function categoryAction() {
		if (!empty($_POST)) {
			if (isset($_POST['getCategory_f'])) {
				$this->view->dataAjax($this->model->dbSelectFromWhere('*', 'category', 'status', 1, 'row'));
			}
		}
	}

    public function adslineAction() {
        if (!empty($_POST)) {
            if (isset($_POST['getCategory_f'])) {
                $this->view->dataAjax($this->model->dbSelectFromWhere('*', 'category', 'status', 1, 'row'));
            }
        }
    }

    public function getCountiesAction() {
        if (!empty($_POST)) {
            if (isset($_POST['get'])) {
                $this->view->dataAjax(
                    $vars = [
                        'village' => $this->model->dbSQL("row", "SELECT * FROM located_village"),
                        'region' => $this->model->dbSQL("KEYPAIR", "SELECT id, region FROM located_region"),
                        'area' => $this->model->dbSQL("KEYPAIR", "SELECT id, area FROM located_area"),
                    ]
                );
            }
        }
    }
}