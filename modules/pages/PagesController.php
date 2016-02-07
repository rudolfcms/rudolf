<?php
/**
 * This file is part of pages Rudolf module.
 * 
 * Pages controller
 * 
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package Rudolf\Modules\pages
 * @version 0.1
 */

namespace Rudolf\Modules\pages;

class PagesController extends \Rudolf\Modules\_front\Controller {
	
	public function page($sAddress) {
		$addressArray = explode('/', trim($sAddress, '/'));

		$model = new PagesModel();
		$pagesList = $model->getPagesList();
		$pageId = $model->getPageIdByPath($addressArray, $pagesList);

		if(false === $pageId) {
			throw new \Rudolf\Http\HttpErrorException('No page found (error 404)', 404);
		}

		$pageData = $model->getPageById($pageId);

		$view = new PagesView();
		$view->page($pageData);
		$aAddress = explode('/', $sAddress);
		$view->setFrontData($this->frontData, $aAddress[0]);
		$view->setBreadcrumbsData($pagesList, $aAddress);

		return $view->render();
	}
}
