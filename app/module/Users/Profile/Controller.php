<?php

namespace Rudolf\Modules\Users\Profile;
use Rudolf\Modules\A_admin\AdminController;
use Rudolf\Http\Response;

class Controller extends AdminController {

	public function profile() {
		$model = new Model();

		//$profileInfo = $model->getProfileInfo();

		$view = new View();

		$view->setActive(['user']);

		$view->userCard();
		$view->render('admin');
	}
}
