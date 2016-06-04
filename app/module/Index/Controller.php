<?php
namespace Rudolf\Modules\Index;

use Rudolf\Modules\A_front\FController;
use Rudolf\Component\Modules\Module;
use Rudolf\Component\Helpers\Pagination\Calc as Pagination;
use Rudolf\Component\Http\HttpErrorException;

class Controller extends FController
{
    public function index($page)
    {
        $page = $this->firstPageRedirect($page);

        $model = new Model();
        $view = new View();

        $module = new Module('index');
        $config = $module->getConfig();
        $onPage = $config['on_page'];
        $navNumber = $config['nav_number'];
        
        $pagination = new Pagination($model->getTotalNumber(), $page, $onPage, $navNumber);

        $articles = $model->getList($pagination, [$config['sort'], $config['order']]);

        if (false === $articles and $page > 1) {
            throw new HttpErrorException('No articles page found (error 404)', 404);
        }

        $view->setData($articles, $pagination);
        $view->setFrontData($this->frontData, ['']);

        $view->render();
    }
}
