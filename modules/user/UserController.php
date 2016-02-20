<?php

namespace Rudolf\Modules\user;
use Rudolf\Modules\_admin\AdminController,
	Rudolf\Http\Response;

class UserController extends AdminController {

	public function profile() {
		$model = new UserModel();

		//$profileInfo = $model->getProfileInfo();

		$view = new UserView();
		$view->userCard();
		$view->render('admin');
	}
}
