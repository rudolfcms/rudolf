<?php
namespace Rudolf\Modules\Articles\Category\Roll\Admin;

use Rudolf\Component\Helpers\Pagination\Calc as Pagination;
use Rudolf\Component\Http\Response;
use Rudolf\Framework\Controller\AdminController;
use Rudolf\Modules\Categories\One;
use Rudolf\Modules\Categories\Roll\Admin\Model as ArticlesList;

class Controller extends AdminController
{
    public function getList($page)
    {
        $page = $this->firstPageRedirect($page, 301, $location = '../../list');
        
        $list = new ArticlesList();
        $total = $list->getTotalNumber(['type'=>'articles']);

        $pagination = new Pagination($total, $page);
        $limit = $pagination->getLimit();
        $onPage = $pagination->getOnPage();

        $results = $list->getList($limit, $onPage);

        $view = new View();
        $view->setData($results, $pagination);
        $view->setActive([
            'admin/articles',
            'admin/articles/categories',
            'admin/articles/categories/list'
        ]);
        $view->render('admin');
    }

    public function redirect()
    {
        $response = new Response('', 301);
        $response->setHeader(['Location', DIR . '/admin/articles/categories/list']);
        $response->send();
        exit;
    }
}
