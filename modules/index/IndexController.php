<?php

namespace Rudolf\Modules\index;
use Rudolf\Abstracts\Controller,
	Rudolf\Http\HttpErrorException,
	Rudolf\Modules\index,
	Rudolf\Libs\Pagination;

class IndexController extends Controller {

	public function index($page) {
		$page = $this->firstPageRedirect($page);

		$model = new IndexModel();
		$view = new IndexView();
		
		$pagination = new Pagination($model->getTotalNumber(), $page);

		$articles = $model->getList($pagination);

		if(false === $articles and $page > 1) {
			throw new HttpErrorException('No articles page found (error 404)', 404);
		}

		$view->setData($articles, $pagination);

		$view->render();
	}
}
