<?php

namespace Rudolf\Modules\Pages\Roll\Admin;

use Rudolf\Component\Helpers\Pagination\Calc as Pagination;
use Rudolf\Framework\Controller\AdminController;
use Rudolf\Modules\Pages\One\Model as PageOne;
use Rudolf\Modules\Pages\Roll\Admin\Model as PagesList;
use Rudolf\Modules\Pages\Roll\Model as PagesFullList;

class Controller extends AdminController
{
    public function getList($page)
    {
        $page = $this->firstPageRedirect($page, 301, $location = '../../list');

        $list = new PagesList();
        $total = $list->getTotalNumber('1');

        $pagination = new Pagination($total, $page, 10);
        $limit = $pagination->getLimit();
        $onPage = $pagination->getOnPage();

        $results = $list->getList($limit, $onPage);

        $page = new PageOne();
        $pagesList = new PagesFullList();

        if (!empty($resutls)) {
        foreach ($results as $key => $value) {
                $results[$key] = $page->addToPageUrl(
                    $value,
                    $pagesList->getPagesList()
                );
            }
        }

        $view = new View();
        $view->setData($results, $pagination);
        $view->render('admin');
    }
}
