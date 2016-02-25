<?php

namespace Rudolf\Modules\Dashboard;
use Rudolf\Modules\A_admin\AdminController;

class Controller extends AdminController {
	public function index() {
		$view = new View();

		$view->dashboard();

		$view->render('admin');
	}
}
