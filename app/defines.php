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
define('VER_NAME', '0.0.6-prealpha');
define('NAME', 'rudolf');

if(dirname($_SERVER['SCRIPT_NAME']) == DIRECTORY_SEPARATOR) {
    define('DIR', '');
} else {
    define('DIR', dirname($_SERVER['SCRIPT_NAME']));
}

define('PLUGINS',               DIR . '/content/plugins');
define('THEMES',                DIR . '/content/themes');
define('UPLOADS',               DIR . '/content/uploads');
define('CONTENT',               DIR . '/content');

define('PLUGINS_ROOT',          WEB_ROOT . '/content/plugins');
define('THEMES_ROOT',           WEB_ROOT . '/content/themes');
define('UPLOADS_ROOT',          WEB_ROOT . '/content/uploads');

define('APP_ROOT',              __DIR__);
define('CONFIG_ROOT',           APP_ROOT . '/config');
define('CORE_ROOT',             APP_ROOT . '/core');
define('TEMP_ROOT',             APP_ROOT . '/temp');
define('MODULES_ROOT',          APP_ROOT . '/module');
define('LOG_ROOT',              APP_ROOT . '/log');
