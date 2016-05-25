<?php
/**
 * This file is part of Rudolf articles module.
 * 
 * Article
 * 
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package Rudolf\Modules\Articles\One\Admin
 * @version 0.1
 */

namespace Rudolf\Modules\Articles\One\Admin;
use Rudolf\Modules\Articles\One;

class AArticle extends One\Article {

	public function editUrl() {
		return DIR . '/admin/articles/edit/' . $this->id();
	}

	public function delUrl() {
		return DIR . '/admin/articles/del/' . $this->id();
	}

	/**
	 * Get content for textarea
	 */
	public function textarea() {
		return trim($this->content(false, false, true)); // traits
	}

	public function addCategory() {
		return DIR . '/admin/articles/category/add';
	}
}