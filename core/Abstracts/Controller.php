<?php

/**
 * This file is part of lcms.
 * 
 * Abstract controller.
 * 
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package lcms\Abstracts
 * @version 0.1
 */

namespace lcms\Abstracts;

abstract class Controller {
	
	/**
	 * @var array An array of objects models
	 */
	protected $models = array();

	/**
	 * @var array An Array of objects views
	 */
	protected $views = array();
}
