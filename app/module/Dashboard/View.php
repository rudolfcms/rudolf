<?php
namespace Rudolf\Modules\Dashboard;

use Rudolf\Framework\View\AdminView;

class View extends AdminView
{
	public function dashboard()
	{
		$this->head->setTitle(_('Dashboard'));

		$this->template = 'dashboard';
	}

	public function pageTitle()
	{
		return _('Dashboard');
	}
}
