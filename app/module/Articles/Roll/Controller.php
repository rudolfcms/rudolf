<?php

namespace Rudolf\Modules\Articles\Roll;

use Rudolf\Component\Helpers\Pagination\Calc as Pagination;
use Rudolf\Component\Http\HttpErrorException;
use Rudolf\Component\Modules\Module;
use Rudolf\Framework\Controller\FrontController;

class Controller extends FrontController
{
    /**
     * Get articles list.
     *
     * @param int $page Page number
     *
     * @return bool|string
     */
    public function getList($page)
    {
        $page = $this->firstPageRedirect($page);

        $articles = new Model();
        $total = $articles->getTotalNumber();

        $conf = (new Module('articles'))->getConfig();

        $pagination = new Pagination($total, $page, $conf['on_page'], $conf['nav_number']);
        $limit = $pagination->getLimit();
        $onPage = $pagination->getOnPage();

        $results = $articles->getList($limit, $onPage, [$conf['sort'], $conf['order']]);

        if (false === $results and $page > 1) {
            throw new HttpErrorException('No articles page found (error 404)', 404);
        }

        $view = new View();
        $view->rollView($results, $pagination);
        $view->render();
    }
}
