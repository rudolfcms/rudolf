<?php

namespace Rudolf\Modules\Articles\Roll\Admin;
use Rudolf\Modules\A_admin\AdminView;

class View extends AdminView {

	public function setData($data, $pagination) {
		$this->roll = new ARoll($data, $pagination, '/admin/articles/list');

		$this->head->setTitle($this->pageTitle());

		$this->template = 'articles-list';
	}
	
	protected function pageTitle() {
		return _('Articles list');
	}
}
