<?php

namespace Rudolf\Modules\Users\One\Admin\Profile;

use Rudolf\Framework\Controller\AdminController;

class Controller extends AdminController
{
    public function profile()
    {
        new Model();

        //$profileInfo = $model->getProfileInfo();

        $view = new View();
        $view->userCard();
        $view->render();
    }
}
