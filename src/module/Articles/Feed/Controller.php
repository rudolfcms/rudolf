<?php

namespace Rudolf\Modules\Articles\Feed;

use Rudolf\Component\Helpers\Pagination\Calc as Pagination;
use Rudolf\Component\Http\Response;
use Rudolf\Framework\Controller\FrontController;
use Rudolf\Modules\Articles\Roll\Model as ArticlesList;

class Controller extends FrontController
{
    /**
     * @var View
     */
    private $view;

    /**
     * @var Response
     */
    private $response;

    public function init()
    {
        $list = new ArticlesList();

        $pagination = new Pagination($list->getTotalNumber(), 1, 20);
        $limit = $pagination->getLimit();
        $onPage = $pagination->getOnPage();

        $results = $list->getList($limit, $onPage);

        $this->view = new View();
        $this->view->setArticles($results, $pagination);

        $this->response = new Response();
    }

    public function getAtomFeed()
    {
        $this->response->setContent($this->view->atom());
        $this->response->setHeader(['Content-Type', 'text/xml']);
        //$this->response->setHeader(['Content-Type', 'application/atom+xml']);
        echo $this->response->send();
    }

    public function getRssFeed()
    {
        $this->response->setContent($this->view->rss2());
        $this->response->setHeader(['Content-Type', 'text/xml']);
        //$this->response->setHeader(['Content-Type', 'charset=utf-8']);
        echo $this->response->send();
    }
}
