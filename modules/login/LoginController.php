<?php

namespace Rudolf\Modules\login;

class LoginController {
	public function form($redirect) {
		$model = new LoginModel();
		$view = new LoginView();

		if(isset($_POST['send'])) {
			$login = $model->check($_POST['email'], $_POST['password']);

			if(true === $login) {
				$response = new \Rudolf\Http\Response('');
				$response->setHeader(['Location', DIR . '/admin']);
				$response->send();
				exit;
			}
		}

		$view->form();
		$view->render('admin');
	}
}
