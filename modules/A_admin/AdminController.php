<?php

namespace Rudolf\Modules\A_admin;
use Rudolf\Abstracts\AController,
	Rudolf\Http\Response;

class AdminController extends AController {

	/**
	 * Constructor
	 */
	public function __construct() {
		$model = new AdminModel();
		$this->auth = $model->getAuth();

		// if not logged in
		if(!$this->auth->check()) {
			$response = new Response('');
			$response->setHeader(['Location', DIR . '/user/login']);
			$response->send();
			exit;
		}
		
		AdminView::setUserInfo($this->auth->getUser());
		AdminView::setAdminData([
			'menu_items' => $model->getMenuItems(),
			//'menu_types' => $model->getMenuTypes()
		]);
	}
}
