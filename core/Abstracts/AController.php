<?php
/**
 * This file is part of Rudolf.
 *
 * Abstract controller.
 *
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package Rudolf\Abstracts
 * @version 0.1
 */

namespace Rudolf\Abstracts;
use Rudolf\Http\Response;

abstract class AController {
	
	/**
	 * @var array An array of objects models
	 */
	protected $models = array();

	/**
	 * @var array An Array of objects views
	 */
	protected $views = array();

	/**
	 * Redirect to `up`, if curent page is 1
	 * 
	 * @param int $page
	 * @param int $code
	 * 
	 * @return int|redirection
	 */
	protected function firstPageRedirect($page, $code = 301, $location = '..') {
		if(1 == $page) {
			$response = new Response('', $code);
			$response->setHeader(['Location', $location]);
			$response->send();
			
			exit;
		} elseif(0 === $page) {
			return 1;
		}
		return $page;
	}
}
