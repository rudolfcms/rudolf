<?php

namespace Rudolf\Modules\_admin;

class AdminController extends \Rudolf\Abstracts\Controller {

	public function __construct() {
		$auth = new AdminModel();

		// if not logged in
		if(!$auth->auth()->check()) {
			$response = new \Rudolf\Http\Response('');
			$response->setHeader(['Location', DIR . '/user/login']);
			$response->send();
			exit;
		}
	}
}
