<?php

namespace Rudolf\Modules\login;

class LoginController {
	
	/**
	 * login
	 * 
	 * @param string $redirect
	 * 
	 * @return void
	 */
	public function login($redirect) {
		$model = new LoginModel();

		$login = null;
		if(isset($_POST['send'])) {
			$login = $model->login($_POST['email'], $_POST['password']);
		}

		if(true === $model->check() || 1 === $login) {
			$response = new \Rudolf\Http\Response('');
			$response->setHeader(['Location', DIR . '/admin']);
			$response->send();
			exit;
		}

		$view = new LoginView();
		$view->form();
		$view->render('admin');
	}

	/**
	 * 
	 * 
	 */
	public function logout() {
		$model = new LoginModel();
		$model->logout();

		$response = new \Rudolf\Http\Response('');
		$response->setHeader(['Location', DIR . '/user/login']);
		$response->send();
		exit;
	}
}
