<?php

namespace Rudolf\Modules\_admin;

class AdminController extends \Rudolf\Abstracts\Controller {

	public function __construct() {

		// if not logged in
		if (false) {
			$response = new \Rudolf\Http\Response('');
			$response->setHeader(['Location', DIR . '/login']);
			$response->send();
			exit;
		}
	}
}
