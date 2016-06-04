<?php
namespace Rudolf\Modules\Articles\Roll;

use Rudolf\Modules\A_front\FController;
use Rudolf\Component\Modules\Module;
use Rudolf\Component\Http\HttpErrorException;
use Rudolf\Component\Helpers\Pagination\Calc as Pagination;

use Rudolf\Component\Libs\Pagination;

class Controller extends FController
{
    /**
    * Get articles list
    *
    * @param int $page Page number
    *
    * @return bool|string
    */
    public function getList($page)
    {
        $page = $this->firstPageRedirect($page);

        $model = new Model();
        $view = new View();

        $module = new Module('');
        $config = $module->getConfig();
        $onPage = $config['on_page'];
        $navNumber = $config['nav_number'];
        
        $pagination = new Pagination($model->getTotalNumber(), $page, $onPage, $navNumber);

        $results = $model->getList($pagination, [$config['sort'], $config['order']]);

        if (false === $results and $page > 1) {
            throw new HttpErrorException('No articles page found (error 404)', 404);
        }

        $view->rollView($results, $pagination);
        $view->setFrontData($this->frontData, '');

        $view->render();
    }
}
