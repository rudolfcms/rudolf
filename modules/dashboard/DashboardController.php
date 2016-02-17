<?php

namespace Rudolf\Modules\dashboard;

class DashboardController extends \Rudolf\Modules\_admin\AdminController {
	public function index() {
		$view = new DashboardView();

		$view->dashboard();

		$view->render('admin');
	}
}
