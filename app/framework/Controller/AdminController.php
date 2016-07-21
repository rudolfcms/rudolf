<?php

namespace Rudolf\Framework\Controller;

use Rudolf\Component\Http\Response;
use Rudolf\Framework\Model\AdminModel;
use Rudolf\Framework\View\AdminView;

class AdminController extends BaseController
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        $model = new AdminModel();
        $this->auth = $model->getAuth();

        // if not logged in
        if (!$this->auth->check()) {
            $response = new Response('');
            $response->setHeader(['Location', DIR.'/user/login']);
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
