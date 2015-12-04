<?php

/**
 * This file is part of Rudolf.
 * 
 * Define application constants.
 * 
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package Rudolf
 * @version 0.1
 */

define('VER', 0.1);
define('NAME', 'Rudolf');

/**
 * Define app path to access from browser (if not defineted previosly)
 */
if(!defined('DIR')) {
	// define path (front) on user
	if(dirname($_SERVER['SCRIPT_NAME']) == DIRECTORY_SEPARATOR) {
		define('DIR', '');
	} else {
		define('DIR', dirname($_SERVER['SCRIPT_NAME']));
	}
}
define('ADMIN', 		DIR . '/admin');
define('UPLOADS', 		DIR . '/content/uploads');
define('THEMES', 		DIR . '/themes');
define('PLUGINS', 		DIR . '/content/plugins');
define('GALLERIES', 	DIR . '/content/galleries');

// define path system
define('ROOT', 			__DIR__);
define('CORE', 			ROOT . '/core');
define('CLASSESS', 		ROOT . '/core/classes');

define('TEMP',				ROOT . '/.temp');
define('UPLOADS_ROOT', 		ROOT . '/uploads');
define('THEMES_ROOT', 		ROOT . '/themes');
define('CACHE_ROOT', 		ROOT . '/app/.cache');
define('PLUGINS_ROOT', 		ROOT . '/plugins');
define('LANGUAGE_ROOT',		ROOT . '/languages');
define('MODULES_ROOT', 		ROOT . '/app/modules');
define('LIB', 				ROOT . '/core/Libs');
define('CONFIG_ROOT', 		ROOT . '/config');
define('GALLERIES_ROOT',	ROOT . '/galleries');
define('FUNCTION_ROOT', 	ROOT . '/app/functions');
