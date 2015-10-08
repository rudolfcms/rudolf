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

	public function __construct(Router $router) {
		$this->router = $router;
	}

	public function invoke() {
		if(true === $this->router->run()) {
			$this->explodeName($this->router->getController());
			print_r($this->method);
		} else {

		}
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
		$this->method = $array[1];
	}
}
