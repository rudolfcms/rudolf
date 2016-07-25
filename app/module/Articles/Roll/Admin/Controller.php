<?php

namespace Rudolf\Modules\Articles\Roll\Admin;

use Rudolf\Component\Helpers\Pagination\Calc as Pagination;
use Rudolf\Component\Http\Response;
use Rudolf\Framework\Controller\AdminController;
use Rudolf\Modules\Articles\Roll\Model as ArticlesList;

class Controller extends AdminController
{
    public function getList($page)
    {
        $page = $this->firstPageRedirect($page, 301, $location = '../../list');

        $list = new ArticlesList();
        $total = $list->getTotalNumber('1');

        $pagination = new Pagination($total, $page, 10);
        $limit = $pagination->getLimit();
        $onPage = $pagination->getOnPage();

        $results = $list->getList($limit, $onPage);

        $view = new View();
        $view->setData($results, $pagination);
        $view->render('admin');
    }
}
