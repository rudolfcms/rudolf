<?php
/**
 * This file is part of Rudolf articles module.
 * 
 * This is the controller of articles module.
 * 
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package Rudolf\Modules\Articles\Category
 * @version 0.1
 */
 
namespace Rudolf\Modules\Articles\Category;
use Rudolf\Modules\A_front\FController,
	Rudolf\Modules\Module,
	Rudolf\Http\HttpErrorException,
	Rudolf\Libs\Pagination,
	Rudolf\Modules\Articles\Roll;


class Controller extends FController {

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
		
		$category = new Model();
		$list = new Roll\Model();
		$view = new View();

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
}
