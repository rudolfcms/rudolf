<?php

namespace Rudolf\Modules\Articles\Roll\Admin;
use Rudolf\Modules\A_admin\AdminView,
	Rudolf\Modules\Articles\Traits as Article,
	Rudolf\Modules\Articles\Roll\Traits as Roll;

class View extends AdminView {
	use Article, Roll;

	public function setData($data, $pagination) {
		$this->data = $data;
		$this->pagination = $pagination;
		$this->head->setTitle($this->pageTitle());

		$this->path = '/admin/articles/list';

		$this->template = 'articles-list';
	}

	protected function pageTitle() {
		return _('Articles list');
	}

	protected function editUrl() {
		return DIR . '/admin/articles/edit/' . $this->article['id'];
	}

	protected function deltUrl() {
		return DIR . '/admin/articles/del/' . $this->article['id'];
	}
}
