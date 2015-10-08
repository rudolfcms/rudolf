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

define('LVER', 0.1);
define('LNAME', 'lcms');

/**
 * Define app path to access from browser (if not defineted previosly)
 */
if(!defined('LDIR')) {
	// define path (front) on user
	if(dirname($_SERVER['SCRIPT_NAME']) == DIRECTORY_SEPARATOR) {
		define('LDIR', '');
	} else {
		define('LDIR', dirname($_SERVER['SCRIPT_NAME']));
	}
}

if(!defined('LENV')) define('LENV', 'debug');

define('LADMIN', 		LDIR . '/admin');
define('LUPLOADS', 		LDIR . '/content/uploads');
define('LTHEMES', 		LDIR . '/content/themes');
define('LPLUGINS', 		LDIR . '/content/plugins');
define('LGALLERIES', 	LDIR . '/content/galleries');

// define path system
define('LROOT', 		dirname(__DIR__));
define('LCORE', 		LROOT . '/core');
define('LCLASSESS', 	LROOT . '/core/classes');


define('LUPLOADS_ROOT', 	LROOT . '/content/uploads');
define('LTHEMES_ROOT', 		LROOT . '/content/themes');
define('LCACHE_ROOT', 		LROOT . '/app/.cache');
define('LPLUGINS_ROOT', 	LROOT . '/content/plugins');
define('LLANGUAGE_ROOT',	LROOT . '/content/languages');
define('LMODULES_ROOT', 	LROOT . '/app/modules');
define('LLIB_ROOT', 		LROOT . '/app/Lib');
define('LCONFIG_ROOT', 		LROOT . '/config');
define('LGALLERIES_ROOT',	LROOT . '/content/galleries');
define('LFUNCTION_ROOT', 	LROOT . '/app/functions');
