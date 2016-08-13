<?php

namespace Rudolf\Modules\Users\One\Admin\Logout;

use Rudolf\Framework\Controller\AdminController;

class Controller extends AdminController
{
    public function logout()
    {
        $model = new Model();
        $model->logout();

        $this->redirect(DIR.'/user/login');
    }
}
