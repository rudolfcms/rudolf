<?php

namespace Rudolf\Modules\_front;

class Controller extends \Rudolf\Abstracts\Controller {
	public $frontData;

	public function __construct() {
		$menu = new Model();
		
		$this->frontData = [
			'menu_items' => $menu->getMenuItems(),
			'menu_types' => $menu->getMenuTypes()
		];
	}
}
 