<?php
/**
 * This file is part of Rudolf articles module.
 * 
 * This is the controller of articles module.
 * 
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package Rudolf\Modules\Articles\Feed
 * @version 0.1
 */
 
namespace Rudolf\Modules\Articles\Feed;
use Rudolf\Modules\A_front\FController;
use Rudolf\Modules\Articles\Roll;
use Rudolf\Component\Libs\Pagination;
use Rudolf\Component\Http\Response;


class Controller extends FController {

	/**
	 * Get feed
	 * 
	 * @param string $type Feed type
	 * 
	 * @return void
	 */
	public function getFeed($type) {
		$list = new Roll\Model();
		$view = new View();
		$response = new Response();

		$pagination = new Pagination($list->getTotalNumber(), 1, 20);
		$results = $list->getList($pagination, ['id', 'desc']);
		$view->setArticles($results, $pagination);
		
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
