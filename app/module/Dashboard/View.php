<?php
namespace Rudolf\Modules\Dashboard;

use Rudolf\Framework\View\AdminView;

class View extends AdminView
{
	public function dashboard()
	{
        $this->pageTitle = _('Dashboard');
		$this->head->setTitle($this->pageTitle);

		$this->template = 'dashboard';
	}
}
