<?php

namespace Rudolf\Modules\Articles\One\Admin;
use Rudolf\Modules\A_admin\AdminView,
	Rudolf\Modules\Articles\Traits;

class View extends AdminView {
	use Traits;

	public function setData($article) {
		$this->article = $article;

		$this->head->setTitle($this->pageTitle());

		$this->path = DIR . '/admin/articles/edit/' . $this->id();

		$this->template = 'articles-edit';
	}

	protected function pageTitle() {
		return _('Edit article');
	}

	protected function deltUrl() {
		return DIR . '/admin/articles/del/' . $this->article['id'];
	}
}
