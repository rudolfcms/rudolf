<?php

/**
 * This file is part of lcms.
 * 
 * Modules Routing.
 * 
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package lcms\Modules
 * @version 0.1
 */

namespace lcms\Modules;
use lcms\Routing\RouteCollection;

class ModulesRouting {
	
	private $collection;
	private $modulesList;

	/**
	 * Constructor
	 * 
	 * @param array $modulesList
	 * @param RouteCollection
	 * @param string $path from-root path to modules directory
	 */
	public function __construct(array $modulesList, RouteCollection $collection, $path = '/modules') {
		$this->collection = $collection;
		$this->modulesList = $modulesList;
		$this->path = $path;
	}

	/**
	 * Add routes to collection
	 * 
	 * @return RouteCollection
	 */
	public function addRoutes() {
		$collection = $this->collection;
		for ($i=0; $i < $c = count($this->modulesList); $i++) {
			$file = LROOT . $this->path . '/' . $this->modulesList[$i] . '/routing.php';
			
			if(is_file($file)) {
				include $file;
			}
		}
		return $collection;
	}
}
