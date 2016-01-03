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
use Rudolf\Abstracts\Controller;

class PagesController extends Controller {
	
	// 
	public function page($string) {
		$addressArray = explode('/', trim($string, '/'));

		$model = new PagesModel();
		$pageId = $model->getPageIdByPath($addressArray);

		if(false === $pageId) {
			throw new \Rudolf\Http\HttpErrorException('No page found (error 404)', 404);
		}
	}
}
