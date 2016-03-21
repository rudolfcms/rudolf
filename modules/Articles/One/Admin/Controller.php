<?php

namespace Rudolf\Modules\Articles\One\Admin;
use Rudolf\Modules\A_admin\AdminController,
	Rudolf\Modules\Articles\One;

class Controller extends AdminController {
	
	public function edit($id) {
		$editModel = new Model();

		// if data was send
		if(isset($_POST['update'])) {
			$editModel->update($_POST, $id);
		}

		$model = new One\Model();
		$view = new View();
		
		$one = $model->getOneById($id);

		$view->setDataEdit($one);
		$view->setActive(['admin/articles']);
		$view->render('admin');
	}

	public function add() {		
		$view = new View();

		$article = null;

		// if data was send
		if(isset($_POST['add'])) {
			
		}

		$view->setDataAdd($_POST);

		$view->setActive(['admin/articles', 'admin/articles/add']);

		$view->render('admin');
	}
}
