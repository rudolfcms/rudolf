<?php
/**
 * This file is part of lcms articles module.
 * 
 * This is the controller of articles module.
 * 
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package lcms
 * @version 0.1
 */
 
namespace Modules\articles;
use lcms\Abstracts\Controller,
	lcms\Http\HttpErrorException;

class ArticlesController extends Controller {
	
	/**
	* Manage model and view to display articles list
	*
	* @param int $page Page number
	*
	* @return bool|string
	*/
	public function getList($page) {
	    $model = new ArticlesModel();
	    $view = new ArticlesView();
	    
	    $results = $model->getList($page);
		if(false === $results) {
			throw new HttpErrorException(404);
		}
		
	    return $view->getArticlesListPage($results);
	}

	public function one($year, $month, $slug) {
		$model = new ArticlesModel();
		$view = new ArticleOneView();
		
		$results = $model->getOneByDate($year, $month, $slug);
		if(false === $results) {
			throw new HttpErrorException(404);
		}
		
		$view->setData($results);

		$view->render();
	}
}
