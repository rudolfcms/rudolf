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
     * @throws \InvalidArgumentException
     * @throws HttpErrorException
     * @throws \Exception
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

        if ($page > 1 && $pagination->getAllPages() < $page) {
            throw new HttpErrorException('No articles page found (error 404)', 404);
        }

        $results = $articles->getList($limit, $onPage, [$conf['sort'], $conf['order']]);

        $view = new View();
        $view->rollView($results, $pagination);
        $view->render();
    }
}
