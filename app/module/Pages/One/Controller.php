<?php
namespace Rudolf\Modules\Pages\One;

use Rudolf\Component\Http\HttpErrorException;
use Rudolf\Framework\Controller\FrontController;

class Controller extends FrontController
{
    public function page($sAddress)
    {
        $addressArray = explode('/', trim($sAddress, '/'));

        $model = new Model();
        $pagesList = $model->getPagesList();
        $pageId = $model->getPageIdByPath($addressArray, $pagesList);

        if (false === $pageId) {
            throw new HttpErrorException('No page found (error 404)', 404);
        }

        $pageData = $model->getPageById($pageId);

        $view = new View();
        $view->page($pageData);
        $aAddress = explode('/', $sAddress);

        $temp = '';
        foreach ($aAddress as $key => $value) {
            $active[] = ltrim($temp = $temp . '/' . $value, '/');
        }

        $view->setFrontData($this->frontData, $active);
        $view->setBreadcrumbsData($pagesList, $aAddress);

        return $view->render();
    }
}
