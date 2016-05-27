<?php

namespace Rudolf\Modules\Articles\One\Admin;
use Rudolf\Modules\A_admin\AdminView;
use Rudolf\Html\Text;

class View extends AdminView {

	/**
	 * Set data to edit article
	 * 
	 * @param array $article
	 */
	public function editArticle($article) {
		$this->article = new AArticle($article);

		$this->pageTitle = _('Edit article');
		$this->head->setTitle($this->pageTitle());

		$this->path = $this->article->editUrl();

		$this->templateType = 'edit';

		$this->template = 'articles-one';
	}

	/**
	 * Set data do add article
	 * 
	 * @param array $article
	 * 
	 * @return void
	 */
	public function addArticle($article) {
		$this->article = new AArticle($article);

		$this->pageTitle = _('Add article');
		$this->head->setTitle($this->pageTitle());

		$this->path = DIR . '/admin/articles/add';

		$this->templateType = 'add';

		$this->template = 'articles-one';
	}
}
