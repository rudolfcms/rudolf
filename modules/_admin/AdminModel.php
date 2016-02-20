<?php

namespace Rudolf\Modules\_admin;
use Rudolf\Abstracts\Model,
	Rudolf\Auth\Auth;

class AdminModel extends Model {

	/**
	 * Returns Auth object 
	 * 
	 * @return Auth
	 */
	public function getAuth() {
		return new Auth($this->pdo, $this->prefix);
	}

	/**
	 * @return array
	 */
	public function getMenuItems() {
		$menu = new ModulesMenu();
		return $menu->getMenuItems();
	}
}
