<?php

namespace Rudolf\Modules\A_front;
use Rudolf\Component\Abstracts\AController;

abstract class FController extends AController {
	public $frontData;

	public function __construct() {
		$model = new Model();
		
		$this->frontData = [
			'menu_items' => $model->getMenuItems(),
			'menu_types' => $model->getMenuTypes()
		];
	}
}
