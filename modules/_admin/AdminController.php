<?php

namespace Rudolf\Modules\_admin;

class AdminController extends \Rudolf\Abstracts\Controller {

	public function __construct() {
		echo 'you are not logged in! <a href="login">log in</a>';
		exit;
	}
}
