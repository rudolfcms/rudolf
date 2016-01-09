<?php
/**
 * This file is part of Rudolf articles module.
 * 
 * This is the controller of articles module.
 * 
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package Rudolf\Modules\articles
 * @version 0.1
 */
 
namespace Rudolf\Modules\articles;
use Rudolf\Abstracts\Controller,
	Rudolf\Http\HttpErrorException;

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

		$module = new Module('articles');
		$config = $module->getConfig();
		$onPage = $config['on_page'];
		$navNumber = $config['nav_number'];
		
		$pagination = new Pagination($model->getTotalNumber(), $page, $onPage, $navNumber);

		$results = $model->getList($pagination, [$config['sort'], $config['order']]);

		if(false === $results and $page > 1) {
			throw new HttpErrorException('No articles page found (error 404)', 404);
		}

		$view->setData($results, $pagination);

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
			throw new HttpErrorException('No article found (error 404)', 404);
		}
		
		$model->addView();

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

		$module = new Module('articles');
		$config = $module->getConfig();
		$onPage = $config['on_page'];
		$navNumber = $config['nav_number'];

		$pagination = new Pagination($list->getTotalNumber(['published'=>1, 'category_id'=>$categoryInfo['id']]), $page, $onPage, $navNumber);

		$results = $list->getList($pagination, [$config['sort'], $config['order']]);

		$view->setData($results, $categoryInfo, $pagination);

		$view->render();
	}
}
