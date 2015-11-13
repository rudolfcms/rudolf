<?php

namespace Modules\index;
use Modules\index;

class IndexController {
	public function index($page) {
		$model = new IndexModel();
		$view = new IndexView();

		$articles = $model->getList($page);

		$view->setData($articles);

		$view->render();
	}
}
