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
use Rudolf\Abstracts\Controller,
	Rudolf\Http\HttpErrorException;

class PagesController extends Controller {
	
	public function page($string) {
		$addressArray = explode('/', trim($string, '/'));

		$model = new PagesModel();
		$pageId = $model->getPageIdByPath($addressArray);

		if(false === $pageId) {
			throw new HttpErrorException('No page found (error 404)', 404);
		}

		$pageData = $model->getPageById($pageId);

		$view = new PagesView();
		$view->page($pageData);

		return $view->render();
	}
}
