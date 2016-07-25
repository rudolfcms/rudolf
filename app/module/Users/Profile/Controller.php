<?php

namespace Rudolf\Modules\Users\Profile;

use Rudolf\Framework\Controller\AdminController;

class Controller extends AdminController
{
    public function profile()
    {
        $model = new Model();

        //$profileInfo = $model->getProfileInfo();

        $view = new View();
        $view->userCard();
        $view->render('admin');
    }
}
