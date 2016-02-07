<?php

namespace Rudolf\Modules\dashboard;

class DashboardController extends \Rudolf\Modules\_admin\AdminController {
	public function index() {
		$a = include ROOT . '/modules/index.php';
		print_r($a);
	}
}
