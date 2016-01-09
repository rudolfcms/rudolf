<?php

namespace Rudolf\Modules\index;
use Rudolf\Abstracts\Controller,
	Rudolf\Http\HttpErrorException,
	Rudolf\Modules\index,
	Rudolf\Libs\Pagination,
	Rudolf\Modules\Module;

class IndexController extends Controller {

	public function index($page) {
		$page = $this->firstPageRedirect($page);

		$model = new IndexModel();
		$view = new IndexView();

		$module = new Module('index');
		$config = $module->getConfig();
		$onPage = $config['on_page'];
		$navNumber = $config['nav_number'];
		
		$pagination = new Pagination($model->getTotalNumber(), $page, $onPage, $navNumber);

		$articles = $model->getList($pagination, [$config['sort'], $config['order']]);

		if(false === $articles and $page > 1) {
			throw new HttpErrorException('No articles page found (error 404)', 404);
		}

		$view->setData($articles, $pagination);

		$view->render();
	}
}
