<?php

namespace Rudolf\Modules\index;

class IndexController extends \Rudolf\Modules\_front\Controller {

	public function index($page) {
		$page = $this->firstPageRedirect($page);

		$model = new IndexModel();
		$view = new IndexView();

		$module = new \Rudolf\Modules\Module('index');
		$config = $module->getConfig();
		$onPage = $config['on_page'];
		$navNumber = $config['nav_number'];
		
		$pagination = new \Rudolf\Libs\Pagination($model->getTotalNumber(), $page, $onPage, $navNumber);

		$articles = $model->getList($pagination, [$config['sort'], $config['order']]);

		if(false === $articles and $page > 1) {
			throw new \Rudolf\Http\HttpErrorException('No articles page found (error 404)', 404);
		}

		$view->setData($articles, $pagination);
		$view->setFrontData($this->frontData);

		$view->render();
	}
}
