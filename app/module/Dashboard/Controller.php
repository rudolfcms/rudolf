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
        $view->setActive(['admin/', 'admin/overview']);
        $view->render('admin');
    }

    public function redirect()
    {
        $response = new Response('', 301);
        $response->setHeader(['Location', DIR.'/admin/overview']);
        $response->send();
        exit;
    }
}
