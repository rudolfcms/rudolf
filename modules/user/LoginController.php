<?php

namespace Rudolf\Modules\user;
use Rudolf\Http\Response;

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

		$status = null;
		if(isset($_POST['send'])) {
			$status = $model->login($_POST['email'], $_POST['password']);
		}

		if(true === $model->check() || 1 === $status) {
			$response = new Response('');
			$response->setHeader(['Location', DIR . '/admin']);
			$response->send();
			exit;
		}

		$view = new LoginView();
		$view->form($_POST, $status);
		$view->render('admin');
	}

	/**
	 * logout
	 * 
	 * @return void
	 */
	public function logout() {
		$model = new LoginModel();
		$model->logout();

		$response = new Response('');
		$response->setHeader(['Location', DIR . '/user/login']);
		$response->send();
		exit;
	}
}
