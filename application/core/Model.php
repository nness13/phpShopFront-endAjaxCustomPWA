<?php

namespace application\core;

use application\lib\Db;
//use application\traits\InstagramTrait;
use application\traits\EmailTrait;

abstract class Model {
//    use InstagramTrait;
    use EmailTrait;

    public $db;
	
	public function __construct() {
		$this->db = new Db;
	}

    public function whoStatus($status){
            switch ($status){
                case 0:
                    $who = 'Новий користувач';
                    break;
                case 1:
                    $who = 'Підтвержений користувач';
                    break;
                case 2:
                    $who = 'Партнер';
                    break;
                case 3:
                    $who = 'Творець';
                    break;
                case 4:
                    $who = 'Водій';
                    break;
            }
            return $who;
    }

    public function members($from, $what = '') {
        return $this->db->column("SELECT COUNT(*) FROM $from $what");
    }

	public function dbDeleteFromWhere($from, $where, $paramdata) {
		$params = [
			$where => $paramdata,
		];
		return $this->db->query("DELETE FROM $from WHERE $where =  :$where", $params);
	}

	public function dbSelectFromWhere($select, $from, $param1, $paramdata, $method = "column", $sorting = NULL) {
		$params = [
			$param1 => $paramdata,
		];
		return $this->db->$method("SELECT $select FROM $from WHERE $param1 = :$param1 $sorting", $params);
	}

	public function dbSQL($method, $sql, $params = []) {
		return $this->db->$method($sql, $params);
	}

	public function dbSelectAll($select, $from, $sorting = NULL) {
		 return $this->db->row("SELECT $select FROM $from $sorting");
	}

	public function createToken() {
		return substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyz', 30)), 0, 30);
	}

    public function delFolder($dir){
        $files = array_diff(scandir($dir), array('.','..'));
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? delFolder("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);
    }

    public function SessionUpdate() {
        $data = $this->dbSelectFromWhere('*', 'accounts', 'id', $_SESSION['account']['id'], 'row');
        $_SESSION['account'] = $data[0];

        $dating = ':'.date('Y-m-d');
        $arrayHistoryIP = explode(',', $_SESSION['account']['historyIP']);
        if($arrayHistoryIP[0] != $_SERVER['REMOTE_ADDR'].$dating){
            $params = [
                'id' => $_SESSION['account']['id'],
                'historyIP' => $_SERVER['REMOTE_ADDR'].$dating.',',
            ];
            $this->db->query("UPDATE accounts SET historyIP = concat(:historyIP, historyIP)  WHERE id = :id", $params);
        }
        $_SESSION['account']['historyIP'] = $_SERVER['REMOTE_ADDR'].$dating.','.$data[0]['historyIP'];
    }
    public function get_visit_info ($route) {
        if(isset($_SESSION['account']['id'])){
            $sess_id = $_SESSION['account']['id'];
        }else{
            $sess_id = null;
        }
        $params = [
            'id' => '',
            'ip' => $_SERVER['REMOTE_ADDR'],
            'time_v' => date('Y-m-d  H:i:s', strtotime('2 hour')),
            'session_id' => $sess_id,
            'route' => $route
        ];
        $values = implode(", :", array_keys($params));
        $this->db->query("INSERT INTO visit_user VALUES (:$values)", $params);
        return $this->db->lastInsertId($id = null);
    }

	// Валідації
	public function validate($input, $post) {
		$rules = [
                // Account
            'name' => [
                'pattern' => '#^[a-zа-ія]{3,15}$#ui',
                'message' => 'Імя вказано неправильно (від 10 до 25 символів)',
            ],
            'login' => [
                'pattern' => '#^[a-zа-ія_]{2,9}$#ui',
                'message' => 'Логін вказаний неправильно (дозволені тільки латинскі літери і цифри від 2 до 15 символів',
            ],
			'email' => [
				'pattern' => '#^([a-z0-9_.-]{1,20}+)@([a-z0-9_.-]+)\.([a-z\.]{2,10})$#',
				'message' => 'Не вірний формат E-mail адресу',
			],
			'number' => [
				'pattern' => '#^[0-9]{10,12}$#',
				'message' => 'Телефон вказаний неправильно (дозволені тільки цифри 12 символів)',
			],
            'password' => [
                'pattern' => '#^[aA-zZа-іыїя!_.0-9]{6,30}$#ui',
                'message' => 'Пароль вказаний неправильно (дозволені тільки латинскі літери і цифри від 6 до 30 символів)',
            ],
			'ref' => [
				'pattern' => '#^[a-zа-ія_]{0,9}$#ui',
				'message' => 'Логін запросившого вказаний неправильно',
			],

                // Goods
			'namegoods' => [
				'pattern' => '#^[A-ZА-Яa-zа-ія\s/0-9]{1,50}$#ui',
				'message' => 'Імя вказано неправильно (від 1 до 50 символів)',				
			],
			'description' => [
				'pattern' => "#^[A-ZА-Яa-zа-іїя0-9-./_,:'</>()\s\n]{0,255}$#ui",
				'message' => 'Невідомий символ (від 0 до 255 символів)',
			],
			'message' => [
				'pattern' => '#^[A-ZА-Яa-zа-ія0-9\s]{0,115}$#ui',
				'message' => 'Не більше 115 знаків',
			],
            'cat' => [
                'pattern' => '#^[0-9]{0,10}$#',
                'message' => 'Телефон вказаний неправильно (дозволені тільки цифри 12 символів)',
            ],
            'search' => [
                'pattern' => "#^[A-ZА-Яa-zа-іїя0-9-./_,:'()\s\n]{0,20}$#ui",
                'message' => ' до 20 символів',
            ],
		];
		foreach ($input as $key => $val) {
			// var_dump($key);
			if (!isset($post[$key]) or !preg_match($rules[$val]['pattern'], $post[$key])) {
				$this->object = $key;
				
				$this->error = 'Поле ' . $key .' з значенням: '.'"'. $post[$key] .'"'. ' - некоректне.' . "\rДозволено:" . $rules[$val]['message'];
				return false;
			}
        }
		return true;
	}


}