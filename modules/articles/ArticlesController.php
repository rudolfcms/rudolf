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

class ArticlesController extends \Rudolf\Modules\_front\Controller {
	
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

		$module = new \Rudolf\Modules\Module('articles');
		$config = $module->getConfig();
		$onPage = $config['on_page'];
		$navNumber = $config['nav_number'];
		
		$pagination = new \Rudolf\Libs\Pagination($model->getTotalNumber(), $page, $onPage, $navNumber);

		$results = $model->getList($pagination, [$config['sort'], $config['order']]);

		if(false === $results and $page > 1) {
			throw new \Rudolf\Http\HttpErrorException('No articles page found (error 404)', 404);
		}

		$view->setData($results, $pagination);
		$view->setFrontData($this->frontData);

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
		$view->setFrontData($this->frontData);

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
		if(empty($categoryInfo)) {
			throw new HttpErrorException('Category not found (error 404)', 404);
		}

		$module = new \Rudolf\Modules\Module('articles');
		$config = $module->getConfig();
		$onPage = $config['on_page'];
		$navNumber = $config['nav_number'];

		$pagination = new \Rudolf\Libs\Pagination($list->getTotalNumber(['published'=>1, 'category_id'=>$categoryInfo['id']]), $page, $onPage, $navNumber);

		$results = $list->getList($pagination, [$config['sort'], $config['order']]);

		$view->setData($results, $pagination, $categoryInfo);
		$view->setFrontData($this->frontData);

		$view->render();
	}
}
