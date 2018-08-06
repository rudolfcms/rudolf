<?php

namespace Rudolf\Modules\Modules\Roll\Admin;

use Rudolf\Component\Helpers\Pagination\Calc as Pagination;
use Rudolf\Framework\Controller\AdminController;

class Controller extends AdminController
{
    /**
     * @param $page
     *
     * @throws \Rudolf\Component\Html\Exceptions\TemplateNotFoundException
     * @throws \Rudolf\Component\Html\Exceptions\ThemeNotFoundException
     */
    public function getList($page)
    {
        $page = $this->firstPageRedirect($page, 301, $location = '../../list');

        $model = new Model();

        $pagination = new Pagination($model->getTotalNumber(), $page, 15);
        $limit = $pagination->getLimit();
        $onPage = $pagination->getOnPage();

        $results = $model->getList($limit, $onPage);

        $view = new View();
        $view->setData($results, $pagination);
        $view->render();
    }
}
