<?php

namespace Rudolf\Modules\Pages\One;

use Rudolf\Component\Http\HttpErrorException;
use Rudolf\Framework\Controller\FrontController;
use Rudolf\Modules\Pages\Roll\Model as PagesList;

class Controller extends FrontController
{
    public function page($stringAddress)
    {
        $addressArray = explode('/', trim($stringAddress, '/'));
        $page = new Model();

        $pagesList = (new PagesList())->getPagesList();
        $pageID = $page->getPageIdByPath($addressArray, $pagesList);

        if (false === $pageID) {
            throw new HttpErrorException('No page found (error 404)', 404);
        }

        $pageInfo = $page->getOneById($pageID);

        $view = new View();
        $view->page($pageInfo);
        $view->setBreadcrumbsData($pagesList, $addressArray);
        $view->render();
    }
}
