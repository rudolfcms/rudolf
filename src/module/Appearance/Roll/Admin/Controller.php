<?php

namespace Rudolf\Modules\Appearance\Roll\Admin;

use Rudolf\Component\Helpers\Pagination\Calc as Pagination;
use Rudolf\Framework\Controller\AdminController;
use Rudolf\Modules\Appearance\Roll\Admin\Model as AppearanceList;

class Controller extends AdminController
{
    public function getList($page)
    {
        $page = $this->firstPageRedirect($page, 301, $location = '../../list');

        $list = new AppearanceList();
        $total = $list->getTotalNumber('1=1');

        $pagination = new Pagination($total, $page);
        $limit = $pagination->getLimit();
        $onPage = $pagination->getOnPage();

        $results = $list->getList($limit, $onPage);
        $view = new View();
        $view->setData($results, $pagination);
        $view->render('admin');
    }
}
