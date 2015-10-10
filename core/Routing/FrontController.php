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
	 * 
	 * @return void
	 */
	public function invoke() {
		if(false === $this->router->run()) {
			echo "not route match";
			return;
		}

		$this->explodeName($this->router->getController());

		if(!class_exists($this->controller)) {
			echo "class not exists";
			return;
		}

		$object = new $this->controller();
		
		$this->call($object, $this->method, $this->router->getParams());
		
	}

	/**
	 * Call controller method
	 * 
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
	 * @return void
	 */
	private function explodeName($name) {
		$array = explode('::', $name);

		$this->controller = $array[0];

		if(count($array) === 1) return;

		$this->method = $array[1];
	}
}
