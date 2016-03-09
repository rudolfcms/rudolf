<?php

namespace Rudolf\Modules\Articles\One\Admin;
use Rudolf\Modules\A_admin\AdminView,
	Rudolf\Modules\Articles\Traits,
	Rudolf\Html\Text;

class View extends AdminView {
	use Traits;

	/**
	 * Set data to edit article
	 * 
	 * @param array $article
	 */
	public function setDataEdit($article) {
		$this->article = $article;

		$this->head->setTitle($this->pageTitle());

		$this->path = DIR . '/admin/articles/edit/' . $this->id();

		$this->template = 'articles-edit';
	}

	/**
	 * Get content for textarea
	 */
	protected function textarea() {
		return trim($this->content(false, false, true)); // traits
	}

	protected function pageTitle() {
		return _('Edit article');
	}

	protected function delUrl() {
		return DIR . '/admin/articles/del/' . $this->article['id'];
	}

	protected function addCategory() {
		return DIR . '/admin/articles/category/add';
	}

	public function setDataAdd() {
		$this->template = 'articles-add';
	}
}
