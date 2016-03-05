<?php

namespace Rudolf\Modules\Dashboard;

class View extends \Rudolf\Modules\A_admin\AdminView {
	public function dashboard() {

		$this->head->setTitle(_('Dashboard'));

		$this->template = 'dashboard';
	}

	public function pageTitle() {
		
	}
}
