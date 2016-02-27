<?php
/**
 * This file is part of Rudolf articles module.
 * 
 * This is the controller of articles module.
 * 
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package Rudolf\Modules\Articles
 * @version 0.1
 */
 
namespace Rudolf\Modules\Articles;
use Rudolf\Modules\A_front\FController,
	Rudolf\Modules\Module,
	Rudolf\Http\HttpErrorException,
	Rudolf\Libs\Pagination,
	Rudolf\Http\Response;


class Controller extends FController {
	
	/**
	* Get articles list
	*
	* @param int $page Page number
	*
	* @return bool|string
	*/
	public function getList($page) {
		$page = $this->firstPageRedirect($page);

		$model = new Roll\Model();
		$view = new Roll\View();

		$module = new Module('');
		$config = $module->getConfig();
		$onPage = $config['on_page'];
		$navNumber = $config['nav_number'];
		
		$pagination = new Pagination($model->getTotalNumber(), $page, $onPage, $navNumber);

		$results = $model->getList($pagination, [$config['sort'], $config['order']]);

		if(false === $results and $page > 1) {
			throw new HttpErrorException('No articles page found (error 404)', 404);
		}

		$view->setData($results, $pagination);
		$view->setFrontData($this->frontData, '');

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
		$model = new One\Model();
		$view = new One\View();
		
		$results = $model->getOneByDate($year, $month, $slug);
		if(false === $results) {
			throw new HttpErrorException('No article found (error 404)', 404);
		}
		
		$model->addView();

		$view->setData($results);
		$view->setFrontData($this->frontData, '');

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
		
		$category = new Category\Model();
		$list = new Roll\Model();
		$view = new Category\View();

		$categoryInfo = $category->getCategoryInfo($slug);
		if(empty($categoryInfo)) {
			throw new HttpErrorException('Category not found (error 404)', 404);
		}

		$module = new Module('articles');
		$config = $module->getConfig();
		$onPage = $config['on_page'];
		$navNumber = $config['nav_number'];

		$pagination = new Pagination($list->getTotalNumber([
				'published' => 1,
				'category_id' => $categoryInfo['id']
			]), $page, $onPage, $navNumber);

		$results = $list->getList($pagination, [$config['sort'], $config['order']]);

		$view->setData($results, $pagination, $categoryInfo);
		$view->setFrontData($this->frontData, '');

		$view->render();
	}

	/**
	 * Get feed
	 * 
	 * @param string $type Feed type
	 * 
	 * @return void
	 */
	public function getFeed($type) {
		$list = new Roll\Model();
		$view = new Feed\View();
		$response = new Response();

		$pagination = new Pagination($list->getTotalNumber(), 1, 20);
		$results = $list->getList($pagination, ['id', 'desc']);
		$view->setArticles($results);
		
		switch ($type) {
			case 'atom':
				$response->setContent($view->atom());
				$response->setHeader(['Content-Type', 'text/xml']);
				//$response->setHeader(['Content-Type', 'application/atom+xml']);
				echo $response->send();
				break;

			case 'rss':
			default:
				$response->setContent($view->rss2());
				$response->setHeader(['Content-Type', 'text/xml']);
				//$response->setHeader(['Content-Type', 'charset=utf-8']);
				echo $response->send();
				break;
		}
	}
}
