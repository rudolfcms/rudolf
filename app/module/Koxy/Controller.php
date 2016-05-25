<?php

namespace Rudolf\Modules\Koxy;
use Rudolf\Modules\A_front\FController,
	Rudolf\Component\Http\HttpErrorException,
	Rudolf\Component\Libs\Pagination,
	Rudolf\Component\Modules\Module;

class Controller extends FController {

	public function index($page) {
		$page = $this->firstPageRedirect($page);

		$model = new Model();
		$view = new View();

		$module = new Module('koxy');
		$config = $module->getConfig();
		$onPage = $config['on_page'];
		$navNumber = $config['nav_number'];
		
		$pagination = new Pagination($model->getTotalNumber(), $page, $onPage, $navNumber);

		$koxy = $model->getList($pagination, [$config['sort'], $config['order']]);

		if(false === $koxy and $page > 1) {
			throw new HttpErrorException('No koxy page found (error 404)', 404);
		}

		$view->setData($koxy, $pagination);
		$view->setFrontData($this->frontData, '');

		$view->render();
	}

	public function vote($type) {
		$model = new Model();
		$view = new View();

		$response = $model->vote($type, $_POST);

		$view->data = $response;
		$view->render('', 'json');
	}
}
