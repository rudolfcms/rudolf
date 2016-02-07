<?php
/**
 * This file is part of Rudolf articles module.
 * 
 * This is the model of articles module.
 * 
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package Rudolf\Modules\articles
 * @version 0.1
 */
 
namespace Rudolf\Modules\articles;

class ArticlesCategoryView extends ArticlesListView {

	// $info = false; to compatible with ArticlesListView
	public function setData($data, \Rudolf\Libs\Pagination $pagination, $info = false) {
		$this->data = $data;
		
		$this->categoryInfo = $info;

		$this->pagination = $pagination;

		$this->path = '/artykuly/kategorie/'. $info['slug'];

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
