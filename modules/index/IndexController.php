<?php

namespace Rudolf\Modules\index;
use Rudolf\Abstracts\Controller,
	Rudolf\Http\HttpErrorException,
	Rudolf\Modules\index;

class IndexController extends Controller {

	public function index($page) {
		$page = $this->firstPageRedirect($page);

		$model = new IndexModel();
		$view = new IndexView();

		$articles = $model->getList($page);

		if(false === $articles and $page > 1) {
			throw new HttpErrorException('No articles page found (error 404)', 404);
		}

		$view->setData($articles, ['total' => $model->total, 'page' => $page]);

		$view->render();
	}
}
