<?php
namespace Rudolf\Modules\Dashboard;

use Rudolf\Modules\A_admin\AdminView;

class View extends AdminView
{
	public function dashboard()
	{
		$this->head->setTitle(_('Dashboard'));

		$this->template = 'dashboard';
	}

	public function pageTitle()
	{
		
	}
}
