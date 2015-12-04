<?php

namespace Rudolf\Modules\index;
use Rudolf\Abstracts\Controller,
	Rudolf\Modules\index;

class IndexController extends Controller {

	public function index($page) {
		$page = $this->firstPageRedirect($page);

		$model = new IndexModel();
		$view = new IndexView();

		$articles = $model->getList($page);
		$view->setData($articles, ['total' => $model->total, 'page' => $page]);

		$view->render();
	}
}
