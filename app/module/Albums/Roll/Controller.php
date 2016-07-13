<?php
namespace Rudolf\Modules\Albums\Roll;

use Rudolf\Component\Helpers\Pagination\Calc as Pagination;
use Rudolf\Component\Http\HttpErrorException;
use Rudolf\Component\Modules\Module;
use Rudolf\Framework\Controller\FrontController;

class Controller extends FrontController
{
    /**
    * Get albums list
    *
    * @param int $page Page number
    *
    * @return bool|string
    */
    public function getList($page)
    {
        $module = new Module('albums');
        $config = $module->getConfig();

        // tu się może coś zepsuć
        $page = $this->firstPageRedirect($page, 301, trim(DIR . $config['path']), '/');

        $model = new Model();
        $view = new View();

        $onPage = $config['on_page'];
        $navNumber = $config['nav_number'];
        
        $pagination = new Pagination($model->getTotalNumber(), $page, $onPage, $navNumber);

        $results = $model->getList($pagination, [$config['sort'], $config['order']]);

        if (false === $results and $page > 1) {
            throw new HttpErrorException('No albums page found (error 404)', 404);
        }

        $view->rollView($results, $pagination);
        $view->setFrontData($this->frontData, '');

        $view->render();
    }
}
