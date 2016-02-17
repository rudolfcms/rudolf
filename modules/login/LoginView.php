<?php

namespace Rudolf\Modules\login;

class LoginView extends \Rudolf\Abstracts\View {
	public function form() {
		$this->template = 'login';
	}
}
