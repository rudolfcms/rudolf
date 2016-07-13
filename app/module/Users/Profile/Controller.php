<?php
namespace Rudolf\Modules\Users\Profile;

use Rudolf\Component\Http\Response;
use Rudolf\Framework\Controller\AdminController;

class Controller extends AdminController
{

    public function profile()
    {
        $model = new Model();

        //$profileInfo = $model->getProfileInfo();

        $view = new View();

        $view->setActive(['user']);

        $view->userCard();
        $view->render('admin');
    }
}
