<?php
namespace Rudolf\Modules\Dashboard;

use Rudolf\Component\Http\Response;
use Rudolf\Modules\A_admin\AdminController;

class Controller extends AdminController
{
    public function index()
    {
        $view = new View();

        $view->dashboard();

        $view->setActive(['admin/']);

        $view->render('admin');
    }
    public function redirect()
    {
        $response = new Response('', 301);
        $response->setHeader(['Location', DIR . '/admin/overview']);
        $response->send();
        exit;
    }
}
