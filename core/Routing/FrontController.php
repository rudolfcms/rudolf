<?php

/**
 * This file is part of lcms.
 * 
 * Front Controller.
 * 
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package lcms\Routing
 * @version 0.1
 */

namespace lcms\Routing;
use lcms\Http\HttpErrorException;

class FrontController {

	/**
	 * @var Router object
	 */
	private $router;

	/**
	 * @var string Controller name
	 */
	private $controller;

	/**
	 * @var string Method name
	 */
	private $method;

	/**
	 * @var array Params array
	 */
	private $params;

	/**
	 * Constructor
	 * 
	 * @param Router
	 */
	public function __construct(Router $router) {
		$this->router = $router;
	}

	/**
	 * Run
	 * 
	 * @return void
	 */
	public function run() {
		try {
			if(false === $this->router->run()) {
				throw new HttpErrorException(506);
			}

			$names = $this->explodeName($this->router->getControllerName());

			if(!class_exists($names[0])) {
				return print "class not exists";
			}

			$this->call(new $names[0](), $names[1], $this->router->getParams());
		} catch(HttpErrorException $e) {
			die($e);
		}
	}

	/**
	 * Call controller method
	 * 
	 * @param object @object
	 * @param string $method
	 * @param array $params
	 * 
	 * @return void
	 */
	private function call($object, $method = 'index', $params) {
		if(null === $method) {
			$method = 'index';
		}
		call_user_func_array(array($object, $method), $params);
	}

	/**
	 * Divides the the name of the class and method
	 * 
	 * @param string $name
	 * 
	 * @return array|bool
	 */
	private function explodeName($name) {
		$array = explode('::', $name);

		if(!empty($array)) {
			return $array; 
		}

		return false;
	}
}
