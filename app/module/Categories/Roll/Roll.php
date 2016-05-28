<?php
/**
 * This file is part of Rudolf articles module.
 * 
 * Categories roll
 * 
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package Rudolf\Modules\Categories\Roll
 * @version 0.1
 */

namespace Rudolf\Modules\Categories\Roll;
use Rudolf\Component\Html\Navigation;
use Rudolf\Component\Libs\Pagination;
use Rudolf\Modules\Categories\One\Admin\Category;
	
class Roll {

	/**
	 * @var string
	 */
	protected $path;

	/**
	 * @var int
	 */
	protected $current = -1;

	/**
	 * @var array
	 */
	protected $data;

	/**
	 * Constructor
	 * 
	 * @param array $data
	 * @param Pagination $pagination
	 * @param string $path
	 */
	public function __construct($data, $pagination, $path = '') {
		$this->data = $data;
		$this->pagination = $pagination;
		$this->path = $path;
	}

	/**
	 * Chech, is any categories to display
	 * 
	 * @return bool
	 */
	public function isCategories() {
		return is_array($this->data);
	}

	/**
	 * Returns number of categories to display on page
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
	public function haveCategories() {
		if ($this->current + 1 < $this->total()) {
			return true;
		}
		return false;
	}

	/**
	 * Set the current category
	 *
	 * @return void
	 */
	public function category() {
		$this->current += 1;
		$category = new Category();
		$category->setData($this->data[$this->current]);

		return $category;
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
