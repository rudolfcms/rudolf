<?php
/**
 * This file is part of lcms.
 * 
 * Contains a collection of class members Route
 * 
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package lcms\Routing
 * @version 0.1
 */

namespace lcms\Routing;

class RouteCollection {

	/**
	 * @var array
	 */
	private $collection;

	/**
	 * Adds a route
	 * 
	 * @param string $name  The route name
	 * @param Route  $item A Route instance
	 * 
	 * @return void
	 */
	public function add($name, Route $item) {
		$this->collection[$name] = $item;
	}

	/**
	 * Gets a route by name
	 * 
	 * @param string $name The route name
	 * 
	 * @return Route|null
	 */
	public function get($name) {
		//!array_key_exists($name, $this->collection)
		if(!isset($this->collection[$name])) {
			return null;
		}
		return $this->collection[$name];
	}

	/**
	 * Returns all routes in this collection
	 *
	 * @return Route array An array of routes collection
	 */
	public function getAll() {
		return $this->collection;
	}
}
