<?php

namespace Rudolf\Modules\_front;

class Controller extends \Rudolf\Abstracts\Controller {
	public $frontData;

	public function __construct() {
		$model = new Model();
		
		$this->frontData = [
			'menu_items' => $model->getMenuItems(),
			'menu_types' => $model->getMenuTypes()
		];
	}
}
 