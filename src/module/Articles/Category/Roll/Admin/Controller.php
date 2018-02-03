<?php

namespace Rudolf\Modules\Articles\Category\Roll\Admin;

use Rudolf\Component\Helpers\Pagination\Calc as Pagination;
use Rudolf\Framework\Controller\AdminController;
use Rudolf\Modules\Categories\Roll\Admin\Model as ArticlesList;

class Controller extends AdminController
{
    /**
     * @param $page
     *
     * @throws \InvalidArgumentException
     */
    public function getList($page)
    {
        $page = $this->firstPageRedirect($page, 301, $location = '../../list');

        $list = new ArticlesList();
        $total = $list->getTotalNumber(['type' => 'articles']);

        $pagination = new Pagination($total, $page);
        $limit = $pagination->getLimit();
        $onPage = $pagination->getOnPage();

        $results = $list->getList($limit, $onPage);

        $view = new View();
        $view->setData($results, $pagination);
        $view->render('admin');
    }
}
