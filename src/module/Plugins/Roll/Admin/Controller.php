<?php

namespace Rudolf\Modules\Plugins\Roll\Admin;

use Rudolf\Component\Helpers\Pagination\Calc as Pagination;
use Rudolf\Component\Html\Exceptions\TemplateNotFoundException;
use Rudolf\Component\Html\Exceptions\ThemeNotFoundException;
use Rudolf\Framework\Controller\AdminController;

class Controller extends AdminController
{
    /**
     * @param $page
     *
     * @throws TemplateNotFoundException
     * @throws ThemeNotFoundException
     */
    public function getList($page)
    {
        $page = $this->firstPageRedirect($page, 301, $location = '../../list');

        $list = new Model();
        $total = $list->getTotalNumber();

        $pagination = new Pagination($total, $page, 10);
        $limit = $pagination->getLimit();
        $onPage = $pagination->getOnPage();

        $results = $list->getList($limit, $onPage);

        $view = new View();
        $view->setData($results, $pagination);
        $view->render();
    }
}
