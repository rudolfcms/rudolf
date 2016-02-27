<?php
 
namespace Rudolf\Modules\Articles\Roll;
use Rudolf\Libs\Pagination,
	Rudolf\Html\Navigation;
	
trait Traits {
	

	public $path;

	private $current = -1;

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
	 * @param int $navNumber
	 * 
	 * @return string
	 */
	public function nav($classes, $nesting = 2) {
		$nav = new Navigation();
		$calculations = $this->pagination->nav();
		
		return $nav->createPagingNavigation($calculations, $this->path, $classes, $nesting);
	}

	/**
	 * Checks if pagination is needed
	 * 
	 * @return bool
	 */
	public function isPagination() {
		return 1 < $this->pagination->getAllPages();
	}
}