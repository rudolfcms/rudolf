<?php

namespace Rudolf\Modules\koxy;
use Rudolf\Abstracts\Controller,
	Rudolf\Http\HttpErrorException,
	Rudolf\Modules\koxy,
	Rudolf\Libs\Pagination,
	Rudolf\Modules\Module;

class KoxyController extends Controller {

	public function index($page) {
		$page = $this->firstPageRedirect($page);

		$model = new KoxyModel();
		$view = new KoxyView();

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

		$view->render();
	}
}
