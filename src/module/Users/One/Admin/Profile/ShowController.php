<?php

namespace Rudolf\Modules\Users\One\Admin\Profile;

use Rudolf\Framework\Controller\AdminController;

class ShowController extends AdminController
{
    public function profile()
    {
        new ShowModel();

        //$profileInfo = $model->getProfileInfo();

        $view = new ShowView();
        $view->userCard();
        $view->render();
    }
}
