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

namespace Rudolf\Modules\Categories\One\Admin;
use Rudolf\Modules\Categories\One;

class Category extends One\Category {
	public function editUrl() {
		return DIR . '/admin/categories/edit/' . $this->id();
	}

	public function delUrl() {
		return DIR . '/admin/categories/del/' . $this->id();
	}
}
