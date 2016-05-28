<?php

namespace Rudolf\Modules\Categories\Roll\Admin;
use Rudolf\Component\Libs\Pagination;
use Rudolf\Modules\A_admin\AdminController;
use Rudolf\Modules\Categories\Roll;

class Controller extends AdminController {
	public function getList($page) {
		$page = $this->firstPageRedirect($page, 301, $location = '../../list');
		
		$list = new Roll\Model();
		$pagination = new Pagination($list->getTotalNumber(), $page);
		$results = $list->getList($pagination);

		$view = new View();

		$view->setData($results, $pagination);

		$view->setActive(['admin/categories', 'admin/categories/list']);

		$view->render('admin');
	}
}
