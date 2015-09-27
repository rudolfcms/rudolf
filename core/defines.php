<?php defined('LCMS') or die();
/**
 * This file is part of lcms.
 * 
 * Define application constants.
 * 
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package lcms
 * @version 0.1
 */

define('APP_VER', 0.1);
define('APP_NAME', 'lcms');

/**
 * Define app path to access from browser (if not defineted previosly)
 */
if(!defined('APP_DIR')) {
	// define path (front) on user
	if(dirname($_SERVER['SCRIPT_NAME']) == DIRECTORY_SEPARATOR) {
		define('APP_DIR', '');
	} else {
		define('APP_DIR', dirname($_SERVER['SCRIPT_NAME']));
	}
}

if(!defined('APP_ENV')) define('APP_ENV', 'debug');

define('APP_ADMIN', 		APP_DIR . '/admin');
define('APP_UPLOADS', 		APP_DIR . '/content/uploads');
define('APP_THEMES', 		APP_DIR . '/content/themes');
define('APP_PLUGINS', 		APP_DIR . '/content/plugins');
define('APP_GALLERIES', 	APP_DIR . '/content/galleries');

// define path system
define('APP_ROOT', dirname(__DIR__));
define('CORE', 				APP_ROOT . '/core');
define('APP_UPLOADS_ROOT', 	APP_ROOT . '/content/uploads');
define('APP_THEMES_ROOT', 	APP_ROOT . '/content/themes');
define('APP_CACHE_ROOT', 	APP_ROOT . '/app/.cache');
define('APP_PLUGINS_ROOT', 	APP_ROOT . '/content/plugins');
define('APP_LANGUAGE_ROOT', APP_ROOT . '/content/languages');
define('APP_MODULES_ROOT', 	APP_ROOT . '/app/modules');
define('APP_LIB_ROOT', 		APP_ROOT . '/app/Lib');
define('APP_CONFIG_ROOT', 	APP_ROOT . '/config');
define('APP_GALLERIES_ROOT',APP_ROOT . '/content/galleries');
define('APP_FUNCTION_ROOT', APP_ROOT . '/app/functions');
