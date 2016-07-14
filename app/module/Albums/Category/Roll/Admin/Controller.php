<?php
namespace Rudolf\Modules\Albums\Category\Roll\Admin;

use Rudolf\Component\Helpers\Pagination\Calc as Pagination;
use Rudolf\Component\Http\Response;
use Rudolf\Framework\Controller\AdminController;
use Rudolf\Modules\Categories\One;
use Rudolf\Modules\Categories\Roll\Admin\Model as CategoriesRoll;

class Controller extends AdminController
{
    public function getList($page)
    {
        $page = $this->firstPageRedirect($page, 301, $location = '../../list');
        
        $list = new CategoriesRoll();
        $total = $list->getTotalNumber(['type'=>'albums']);

        $pagination = new Pagination($total, $page);
        $limit = $pagination->getLimit();
        $onPage = $pagination->getOnPage();

        $results = $list->getList($limit, $onPage);

        $view = new View();
        $view->setData($results, $pagination);
        $view->setActive([
            'admin/albums',
            'admin/albums/categories',
            'admin/albums/categories/list'
        ]);
        $view->render('admin');
    }
    
    public function redirect()
    {
        $response = new Response('', 301);
        $response->setHeader(['Location', DIR . '/admin/albums/categories/list']);
        $response->send();
        exit;
    }
}
