<?php

namespace Rudolf\Modules\Index;

use Rudolf\Component\Helpers\Pagination\Calc as Pagination;
use Rudolf\Component\Http\HttpErrorException;
use Rudolf\Component\Modules\Module;
use Rudolf\Framework\Controller\FrontController;
use Rudolf\Modules\Articles\Roll\Model as ArticlesList;

class Controller extends FrontController
{
    public function index($page)
    {
        $page = $this->firstPageRedirect($page);

        $list = new ArticlesList();
        $total = $list->getTotalNumber();

        $conf = (new Module('index'))->getConfig();

        $pagination = new Pagination($total, $page, $conf['on_page'], $conf['nav_number']);
        $limit = $pagination->getLimit();
        $onPage = $pagination->getOnPage();

        if ($pagination->getAllPages() < $page) {
            throw new HttpErrorException('No articles page found (error 404)', 404);
        }

        $results = $list->getList($limit, $onPage, [$conf['sort'], $conf['order']]);

        $view = new View();
        $view->setData($results, $pagination);
        $view->setFrontData($this->frontData);
        $view->render();
    }
}
