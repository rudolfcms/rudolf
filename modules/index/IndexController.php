<?php

namespace Modules\index;
use lcms\Abstracts\Controller,
	Modules\index;

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
