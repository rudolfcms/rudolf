<?php
namespace Rudolf\Modules\Articles\Feed;

use Rudolf\Component\Helpers\Pagination\Calc as Pagination;
use Rudolf\Component\Http\Response;
use Rudolf\Framework\Controller\FrontController;
use Rudolf\Modules\Articles\Roll\Model as ArticlesList;

class Controller extends FrontController
{
    /**
     * Get feed
     * 
     * @param string $type Feed type
     * 
     * @return void
     */
    public function getFeed($type)
    {
        $list = new ArticlesList();
        $total = $list->getTotalNumber();

        $pagination = new Pagination($total, 1, 20);
        $limit = $pagination->getLimit();
        $onPage = $pagination->getOnPage();

        $results = $list->getList($limit, $onPage);

        $view = new View();
        $view->setArticles($results, $pagination);
        
        $response = new Response();
        switch ($type) {
            case 'atom':
                $response->setContent($view->atom());
                $response->setHeader(['Content-Type', 'text/xml']);
                //$response->setHeader(['Content-Type', 'application/atom+xml']);
                echo $response->send();
                break;

            case 'rss':
            default:
                $response->setContent($view->rss2());
                $response->setHeader(['Content-Type', 'text/xml']);
                //$response->setHeader(['Content-Type', 'charset=utf-8']);
                echo $response->send();
                break;
        }
    }
}
