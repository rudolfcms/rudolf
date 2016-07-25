<?php

namespace Rudolf\Modules\Albums\Roll;

use Rudolf\Component\Helpers\Pagination\Calc as Pagination;
use Rudolf\Component\Http\HttpErrorException;
use Rudolf\Component\Modules\Module;
use Rudolf\Framework\Controller\FrontController;

class Controller extends FrontController
{
    /**
     * Get albums list.
     *
     * @param int $page Page number
     */
    public function getList($page)
    {
        $conf = (new Module('albums'))->getConfig();

        $page = $this->firstPageRedirect($page, 301, '../../'.$conf['path']);

        $list = new Model();
        $total = $list->getTotalNumber();

        $pagination = new Pagination($total, $page, $conf['on_page'], $conf['nav_number']);
        $limit = $pagination->getLimit();
        $onPage = $pagination->getOnPage();

        if ($pagination->getAllPages() < $page) {
            throw new HttpErrorException('No albums page found (error 404)', 404);
        }

        $results = $list->getList($limit, $onPage, [$conf['sort'], $conf['order']]);

        $view = new View();
        $view->rollView($results, $pagination);
        $view->render();
    }
}
