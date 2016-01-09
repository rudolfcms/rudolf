<?php
/**
 * This file is part of Rudolf.
 *
 * Module.
 *
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package Rudolf\Modules
 * @version 0.1
 */

namespace Rudolf\Modules;

class Module {
	public function __construct($name) {
		$this->name = $name;
		
		if(empty($name)) {
			throw new \InvalidArgumentException("Invalid module name");
		}
	}

	public function getConfig() {
		$file = CONFIG_ROOT . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . $this->name . '.php';

		if(!file_exists($file)) {
			throw new \Exception("{$this->name} module configuration does not exist");

		}
		return include $file;
	}
}
