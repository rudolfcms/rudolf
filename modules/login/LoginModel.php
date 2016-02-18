<?php

namespace Rudolf\Modules\login;

class LoginModel extends \Rudolf\Abstracts\Model {

	public function check() {
		$auth = new \Rudolf\Auth\Auth($this->pdo, $this->prefix);
		return $auth->check();
	}
	
	public function login($email, $password) {

		$auth = new \Rudolf\Auth\Auth($this->pdo, $this->prefix);
		$status = $auth->login($email, $password);
		return $status;
	}

	public function logout() {
		$auth = new \Rudolf\Auth\Auth($this->pdo, $this->prefix);
		$auth->logout();
	}
}
