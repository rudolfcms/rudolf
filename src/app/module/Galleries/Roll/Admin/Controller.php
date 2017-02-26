<?php

namespace Rudolf\Modules\Galleries\Roll\Admin;

use Rudolf\Component\Helpers\Pagination\Calc as Pagination;
use Rudolf\Framework\Controller\AdminController;
use Rudolf\Modules\Galleries\Roll\Model as GalleriesList;

class Controller extends AdminController
{
    public function getList($page)
    {
        $page = $this->firstPageRedirect($page, 301, $location = '../../list');

        $list = new GalleriesList();
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
