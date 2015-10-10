<?php

/**
 * This file is part of lcms.
 * 
 * Holds one routing element
 * 
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package lcms\Routing
 * @version 0.1
 */

namespace lcms\Routing;

class Route {

	/**
	 * @var string 
	 */
	private $path;

	/**
	 * @var string
	 */
	private $controllerName;

	/**
	 * @var array
	 */
	private $params = array();

	/**
	 * @var array
	 */
	private $defaults = array();
	
	/**
	 * Constructor
	 * 
	 * @param string	$path				The path pattern to match
	 * @param array		$controllerName		Controller to use for route
	 * @param array 	$params 			Params
	 * @param array		$defaults			An array of default parameter values
	 */
	public function __construct($path, $controllerName, array $params = array(), array $defaults = array()) {
		$this->setPath($path);
		$this->setControllerName($controllerName);
		$this->setParams($params);
		$this->setDefaults($defaults);
	}

	/**
	 * Sets the pattern for the path
	 * 
	 * @access private
	 *
	 * @param string $pattern The path pattern
	 */
	private function setPath($path) {
		$this->path = '/' . ltrim(trim($path), '/');
	}

	/**
	 * Returns the path
	 * 
	 * @access public
	 * 
	 * @return string $path
	 */
	public function getPath() {
		return $this->path;
	}

	/**
	 * Sets the controller name to use for route
	 * 
	 * @access private
	 * 
	 * @param string $controllerName The controller name
	 */
	private function setControllerName($controllerName) {
		$this->controllerName = $controllerName;
	}

	/**
	 * Returns the controller name
	 * 
	 * @access public
	 * 
	 * @return array $controllerName 
	 */
	public function getControllerName() {
		return $this->controllerName;
	}

	/**
	 * Sets the params
	 * 
	 * @access private
	 * 
	 * @param array $params The params
	 */
	private function setParams($params) {
		$this->params = $params;
	}

	/**
	 * Returns the params
	 * 
	 * @access public
	 * 
	 * @return array $params 
	 */
	public function getParams() {
		return $this->params;
	}

	/**
	 * Sets the defaults
	 * 
	 * @access private
	 *
	 * @param array $defaults The defaults
	 */
	private function setDefaults(array $defaults) {
		$this->defaults = $defaults;
	}

	/**
	 * Returns the defaults params
	 * 
	 * @access public
	 *
	 * @return array $defaults The defaults params
	 */
	public function getDefaults() {
		return $this->defaults;
	}
}
