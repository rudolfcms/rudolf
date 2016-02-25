<?php

namespace Rudolf\Modules\A_admin;
use Rudolf\Abstracts\AModel,
	Rudolf\Auth\Auth;

class AdminModel extends AModel {

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
