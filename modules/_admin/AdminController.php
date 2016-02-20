<?php

namespace Rudolf\Modules\_admin;
use Rudolf\Abstracts\Controller,
	Rudolf\Http\Response;

class AdminController extends Controller {

	/**
	 * Constructor
	 */
	public function __construct() {
		$model = new AdminModel();
		$this->auth = $model->getAuth();

		$adminData = [
			'menu_items' => $model->getMenuItems(),
			//'menu_types' => $model->getMenuTypes()
		];

		// if not logged in
		if(!$this->auth->check()) {
			$response = new Response('');
			$response->setHeader(['Location', DIR . '/user/login']);
			$response->send();
			exit;
		}
		
		AdminView::setUserInfo($this->auth->getUser());
		AdminView::setAdminData($adminData);
	}
}
