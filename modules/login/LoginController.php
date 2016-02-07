<?php

namespace Rudolf\Modules\login;

class LoginController {
	public function form($redirect) {
		$view = new LoginView();
		$view->form();
	}
}
