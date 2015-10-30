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
use lcms\Abstracts\Controller;

class ArticlesController extends Controller {
	
	/**
	* Manage model and view to display articles list
	*
	* @param int $page Page number
	*
	* @return bool|string
	*/
	public function articlesList($page) {
	    $model = new ArticlesListModel();
	    $view = new ArticlesListView();
	    
	    $results = $model->getArticlesListArray($page, );
		if(false === $results) {
			return false;
		}
		
	    return $view->getArticlesListaPage($results);
	}

	public function one($year, $month, $slug) {
		$model = new ArticlesOnceModel();
		$view = new ArticlesOnceView();
		
		$results = $model->getArticleOnceArray($year, $month, $slug);
		if(false === $results) {
			return false;
		}
		
		return $view->getArticleOncePage($results);
	}
}
