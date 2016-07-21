<?php

namespace Rudolf\Modules\Koxy\Roll;

use Rudolf\Component\Helpers\Pagination\Calc as Pagination;
use Rudolf\Component\Http\HttpErrorException;
use Rudolf\Component\Modules\Module;
use Rudolf\Framework\Controller\FrontController;

class Controller extends FrontController
{
    public function index($page)
    {
        $page = $this->firstPageRedirect($page);

        $list = new Model();
        $total = $list->getTotalNumber();

        $conf = (new Module('koxy'))->getConfig();

        $pagination = new Pagination($total, $page, $conf['on_page'], $conf['nav_number']);
        $limit = $pagination->getLimit();
        $onPage = $pagination->getOnPage();

        $koxy = $list->getList($limit, $onPage, [$conf['sort'], $conf['order']]);

        if (false === $koxy and $page > 1) {
            throw new HttpErrorException('No koxy page found (error 404)', 404);
        }

        $view = new View();
        $view->setData($koxy, $pagination);
        $view->setFrontData($this->frontData, '');
        $view->render();
    }
}
