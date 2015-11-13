<?php

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
define('LADMIN', 		LDIR . '/admin');
define('LUPLOADS', 		LDIR . '/content/uploads');
define('LTHEMES', 		LDIR . '/themes');
define('LPLUGINS', 		LDIR . '/content/plugins');
define('LGALLERIES', 	LDIR . '/content/galleries');

// define path system
define('LROOT', 		dirname(__DIR__));
define('LCORE', 		LROOT . '/core');
define('LCLASSESS', 	LROOT . '/core/classes');

define('LTEMP',				LROOT . '/.temp');
define('LUPLOADS_ROOT', 	LROOT . '/uploads');
define('LTHEMES_ROOT', 		LROOT . '/themes');
define('LCACHE_ROOT', 		LROOT . '/app/.cache');
define('LPLUGINS_ROOT', 	LROOT . '/plugins');
define('LLANGUAGE_ROOT',	LROOT . '/languages');
define('LMODULES_ROOT', 	LROOT . '/app/modules');
define('LLIB', 				LROOT . '/core/Libs');
define('LCONFIG_ROOT', 		LROOT . '/config');
define('LGALLERIES_ROOT',	LROOT . '/galleries');
define('LFUNCTION_ROOT', 	LROOT . '/app/functions');
