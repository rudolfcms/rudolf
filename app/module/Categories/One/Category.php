<?php
/**
 * This file is part of Rudolf categories module.
 * 
 * Category
 * 
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package Rudolf\Modules\Categories\One
 * @version 0.1
 */

namespace Rudolf\Modules\Categories\One;
use Rudolf\Component\Hooks\Hooks;
use Rudolf\Component\Html\Text;
use Rudolf\Component\Images\Image;

class Category {

	/**
	 * @var array Article data
	 */
	protected $category;

	/**
	 * Constructor
	 * 
	 * @param array $category
	 */
	public function __construct($category = array()) {
		$this->setData($category);
	}

	/**
	 * Set category data
	 * 
	 * @param array $category
	 */
	public function setData($category) {
		$this->category = array_merge(
			[
				'id' => 0,
				'category_ID' => 0,
				'title' => '',
				'keywords' => '',
				'description' => '',
				'views' => 0,
				'slug' => '',
				'url' => '',
			],
			(array) $category
		);
	}

	/**
	 * Returns category ID
	 * 
	 * @return int
	 */
	public function id() {
		return (int) $this->category['id'];
	}

	/**
	 * Returns category title
	 * 
	 * @param string $type null|raw
	 * 
	 * @return string
	 */
	public function title($type = '') {
		$title = $this->category['title'];
		if('raw' === $type) {
			return $title;
		}

		return Text::escape($title);
	}

	/**
	 * Returns the keywords
	 * 
	 * @param string $type null|raw
	 * 
	 * @return string
	 */
	public function keywords($type = '') {
		$keywords = $this->category['keywords'];
		if('raw' === $type) {
			return $keywords;
		}

		return Text::escape($keywords);
	}

	/**
	 * Returns the description
	 * 
	 * @param string $type
	 * 
	 * @return string
	 */
	public function description($type = '') {
		$description = $this->category['description'];
		if('raw' === $type) {
			return $description;
		}

		return Text::escape($description);
	}

	/**
	 * Returns the number of views
	 * 
	 * @return int
	 */
	public function views() {
		return (int) $this->category['views'];
	}

	/**
	 * Returns category slug
	 * 
	 * @return string
	 */
	public function slug() {
		return Text::escape($this->category['slug']);
	}

	/**
	 * Returns category url
	 * 
	 * @return string
	 */
	public function url() {
		return sprintf('%1$s/%2$s/%3$s/%4$s/%5$s',
			DIR,
			'artykuly',
			$this->date('Y'),
			$this->date('m'),
			$this->slug()
		);
	}
}
