<?php
namespace Rudolf\Modules\Albums\Roll\Admin;

use Rudolf\Component\Helpers\Pagination\Calc as Pagination;
use Rudolf\Component\Http\Response;
use Rudolf\Framework\Controller\AdminController;
use Rudolf\Modules\Albums\Roll;

class Controller extends AdminController
{
    public function getList($page)
    {
        $page = $this->firstPageRedirect($page, 301, $location = '../../list');

        $list = new Roll\Model();
        
        $pagination = new Pagination($list->getTotalNumber('1=1'), $page);
        $results = $list->getList($pagination);

        $view = new View();

        $view->setData($results, $pagination);

        $view->setActive(['admin/albums', 'admin/albums/list']);

        $view->render('admin');
    }

    public function redirect()
    {
        $response = new Response('', 301);
        $response->setHeader(['Location', DIR . '/admin/albums/list']);
        $response->send();
        exit;
    }
}
