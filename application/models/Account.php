<?php

namespace application\models;

use application\core\Model;

class Account extends Model {

	public function register($post) {
		$token = $this->createToken();
		$params = [
			'id' => '',
			'email' => $post['number'],
			'login' => $post['login'],
			'password' => password_hash($post['password'], PASSWORD_BCRYPT),
			'ref' => $post['ref'],
			'regdate' => date('Y-m-d'),
			'token' => $token,
			'status' => 0,
			'why' => $_SERVER['REMOTE_ADDR'],
            'historyIP' => $_SERVER['REMOTE_ADDR'].':'.date('Y-m-d'),
			'verification' => ''
		];
		$values = implode(", :", array_keys($params));
		$this->db->query("INSERT INTO accounts VALUES (:$values)", $params);
//		$this->send_mail($post['email'], 'Register', 'Confirm: '.stristr($_SERVER["SCRIPT_URI"], $_SERVER['SCRIPT_URL'], true).'/account/confirm/'.$token);
		return $this->db->lastInsertId($id = null);
	}

	public function loginUpdate($post) {
		$params = [
			'id' => $_SESSION['account']['id'],
			'login' => $post['login'],			
		];
		$this->db->query("UPDATE accounts SET login = :login WHERE id = :id", $params);
		$_SESSION['account']['login'] = $post['login'];
	}

	public function passwordUpdate($post) {
	    $password = password_hash($post['password'], PASSWORD_BCRYPT);
		$params = [
			'id' => $_SESSION['account']['id'],
			'password' => $password,
		];
		$this->db->query("UPDATE accounts SET password = :password WHERE id = :id", $params);
        $_SESSION['account']['password'] = $password;
    }

	public function emailUpdate($post) {
		$post['token'] = $this->createToken();
		$params = [
			'id' => $_SESSION['account']['id'],
			'email' => $post['email'],	
			'token' => $post['token'],
			'status' => 0,
		];
		$this->db->query("UPDATE accounts SET email = :email, token = :token, status = :status WHERE id = :id", $params);
		$this->send_mail($post['email'], 'Change E-mail', 'Confirm: '.stristr($_SERVER["SCRIPT_URI"], $_SERVER['SCRIPT_URL'], true).'/account/confirm/'.$post['token']);
		$_SESSION['account'] = $this->dbSelectFromWhere('*', 'accounts', 'id', $_SESSION['account']['id'], 'row')[0];
	}

    public function numberUpdate($post) {
        $params = [
            'id' => $_SESSION['account']['id'],
            'email' => $post['number'],
        ];
        $this->db->query("UPDATE accounts SET email = :email WHERE id = :id", $params);
        $_SESSION['account']['email'] = $post['number'];
    }

    public function recovery($post) {
        $token = $this->createToken();
        $params = [
            'email' => $post['email'],
            'token' => $token,
        ];
        $this->db->query('UPDATE accounts SET token = :token WHERE email = :email', $params);
        $this->send_mail($post['email'], 'Recovery', 'Confirm: '.stristr($_SERVER["SCRIPT_URI"], $_SERVER['SCRIPT_URL'], true).'/account/reset/'.$token);
    }

    public function reset($token) {
        $new_password = $this->createToken();
        $params = [
            'token' => $token,
            'password' => password_hash($new_password, PASSWORD_BCRYPT),
        ];
        $this->db->query('UPDATE accounts SET status = 1, token = "", password = :password WHERE token = :token', $params);
        return $new_password;
    }

		// Допоміжні функції

	public function activate($token) {
		$params = [
			'token' => $token,
		];
		$this->db->query('UPDATE accounts SET status = 1, token = "" WHERE token = :token', $params);
	}

	public function noactivate($token) {
		$params = [
			'token' => $token,
			'id' => $_SESSION['account']['id'],
		];
		$this->db->query('UPDATE accounts SET status = 0, token = :token WHERE id = :id', $params);
	}

	public function checkData($login, $password) {
		$params = [
			'login' => $login,
		];
		$hash = $this->db->column('SELECT password FROM accounts WHERE login = :login', $params);
		if (!$hash or !password_verify($password, $hash)) {
			return false;
		}
		return true;
	}

	public function checkStatus($type, $data) {
		$params = [
			$type => $data,
		];
		$status = $this->db->column('SELECT status FROM accounts WHERE '.$type.' = :'.$type, $params);
		if ($status != 1) {
			$this->error = 'Аккаунт ожидает подтверждения по E-mail';
			return false;
		}
		return true;
	}

}