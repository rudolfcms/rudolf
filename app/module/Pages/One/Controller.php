<?php

namespace Rudolf\Modules\Pages\One;

use Rudolf\Component\Http\HttpErrorException;
use Rudolf\Framework\Controller\FrontController;

class Controller extends FrontController
{
    public function page($stringAddress)
    {
        $addressArray = explode('/', trim($stringAddress, '/'));

        $pages = new Model();
        $pagesList = $pages->getPagesList();
        $pageID = $pages->getPageIdByPath($addressArray, $pagesList);

        if (false === $pageID) {
            throw new HttpErrorException('No page found (error 404)', 404);
        }

        $pageInfo = $pages->getPageById($pageID);

        $view = new View();
        $view->page($pageInfo);
        $view->setBreadcrumbsData($pagesList, $addressArray);
        $view->render();
    }
}
