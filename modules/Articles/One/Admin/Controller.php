<?php

namespace Rudolf\Modules\Articles\One\Admin;
use Rudolf\Modules\A_admin\AdminController,
	Rudolf\Modules\Articles\One;

class Controller extends AdminController {
	
	public function edit($id) {
		$model = new One\Model();
		
		$view = new View();

		$one = $model->getOneById($id);

		$view->setData($one);

		$view->setActive(['admin/articles']);

		$view->render('admin');
	}
}
