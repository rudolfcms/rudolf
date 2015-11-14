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
use lcms\Abstracts\View,
	lcms\Libs\Pagination,
	lcms\Html\Navigation;

class ArticlesListView extends ArticleOneView {

	public $path;

	public function setData($data, $paginationInfo) {
		$this->data = $data;

		$this->paginationInfo = $paginationInfo;

		$this->template = 'index';
	}

	/**
	 * Chech, is any articles to display
	 * 
	 * @return bool
	 */
	public function isArticles() {
		return is_array($this->data);
	}

	/**
	 * Returns number of article to display on page
	 * 
	 * @return int
	 */
	public function total() {
		return count($this->data);
	}

	/**
	 * Whether there are more posts available in the loop
	 *
	 * @return bool
	 */
	public function haveArticles() {
		if ($this->current + 1 < $this->total()) {
			return true;
		}
		return false;
	}

	/**
	 * Set the current article
	 *
	 * @return void
	 */
	public function article() {
		$this->current += 1;
		$this->article = $this->data[$this->current];
	}

	/**
	 * Return navigation
	 * 
	 * @param array $classes
	 * 		ul
	 * 		current
	 * 
	 * @return string
	 */
	public function nav($classes) {
		$nav = $this->paginationInfo;

		$onPage = $this->theme->article['pagination']['onPage'];
		$navNumber = $this->theme->article['pagination']['navNumber'];
		
		$pagination = new Pagination($nav['total'], $nav['page'], $onPage, $navNumber);


		$navigation = new Navigation();
		return $navigation->createPagingNavigation($pagination->nav(), $this->path, $classes, $nesting = 2);

		$list = ($classes['list']) ? $classes['list'] : 'cd-pagination';
		$current = ($classes['current']) ? $classes['current'] : 'current';
	}
}
