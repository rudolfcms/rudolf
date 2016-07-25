<?php

namespace Rudolf\Modules\Dashboard;

use Rudolf\Component\Http\Response;
use Rudolf\Framework\Controller\AdminController;

class Controller extends AdminController
{
    public function index()
    {
        $view = new View();
        $view->dashboard();
        $view->render('admin');
    }
}
