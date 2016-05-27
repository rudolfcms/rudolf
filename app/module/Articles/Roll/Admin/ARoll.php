<?php

namespace Rudolf\Modules\Articles\Roll\Admin;
use Rudolf\Modules\Articles\Roll;
use Rudolf\Modules\Articles\One\Admin\AArticle;

class ARoll extends Roll\Roll {

	/**
	 * Set the current article
	 * 
	 * @overwrite
	 * 
	 * @return void
	 */
	public function article() {
		$this->current += 1;
		$article = new AArticle();
		$article->setData($this->data[$this->current]);

		return $article;
	}
}
