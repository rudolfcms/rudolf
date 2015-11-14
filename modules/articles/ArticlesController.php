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
	* Get articles list
	*
	* @param int $page Page number
	*
	* @return bool|string
	*/
	public function getList($page) {
		$page = $this->firstPageRedirect($page);

		$model = new ArticlesListModel();
		$view = new ArticlesListView();
		
		$results = $model->getList($page);

		$view->setData($results, ['total' => $model->total, 'page' => $page]);
		
		$view->render();
	}

	/**
	 * Get one article
	 * 
	 * @param int $year
	 * @param int $month
	 * @param string $slug
	 * 
	 * @return void
	 */
	public function getOne($year, $month, $slug) {
		$model = new ArticleOneModel();
		$view = new ArticleOneView();
		
		$results = $model->getOneByDate($year, $month, $slug);
		if(false === $results) {
			throw new HttpErrorException(404);
		}
		$view->setData($results);

		$view->render();
	}

	/**
	 * Get articles by category
	 * 
	 * @param string $slug
	 * @param int $page
	 * 
	 * @return void
	 */
	public function getCategory($slug, $page) {
		$page = $this->firstPageRedirect($page, 301, '../../'. $slug); // łork eraułnd
		
		$list = new ArticlesListModel();
		$category = new ArticlesCategoryModel();
		$view = new ArticlesCategoryView();

		$categoryInfo = $category->getCategoryInfo($slug);

		$results = $list->getList($page, ['published'=>1, 'category_id'=>$categoryInfo['id']]);

		$view->setData($results, $categoryInfo, ['total' => $list->total, 'page' => $page]);

		$view->render();
	}
}
