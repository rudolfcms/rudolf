<?php
/**
 * This file is part of lcms articles module.
 * 
 * This is the model of articles module.
 * 
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package lcms
 * @version 0.1
 */
 
namespace Modules\articles;
use lcms\Abstracts\View;

class ArticlesCategoryView extends ArticlesListView {

	public function setData($data, $info) {
		$this->data = $data;
		$this->categoryInfo = $info;

		$this->template = (isset($data['template'])) ? $data['template'] : 'category';
	}

	/**
	 * Returns category title
	 * 
	 * @return string
	 */
	public function categoryTitle() {
		return $this->categoryInfo['title'];
	}

	/**
	 * Returns category description
	 * 
	 * @return string
	 */
	public function categoryDescription() {
		return $this->categoryInfo['description'];
	}
}
