<?php

define('VER', 0.11);
define('VER_NAME', '0.11.0');
define('NAME', 'rudolf');

define('APP_ROOT',      dirname(__DIR__));
define('CORE_ROOT',     APP_ROOT.'/core');
define('MODULES_ROOT',  APP_ROOT.'/src/module');

define('CONFIG_ROOT',   APP_ROOT.'/config');
define('TEMP_ROOT',     APP_ROOT.'/temp');
define('LOG_ROOT',      APP_ROOT.'/log');

define('CONTENT_ROOT',  WEB_ROOT.'/content');
define('PLUGINS_ROOT',  CONTENT_ROOT.'/plugins');
define('THEMES_ROOT',   CONTENT_ROOT.'/themes');
define('UPLOADS_ROOT',  CONTENT_ROOT.'/uploads');

if (dirname($_SERVER['SCRIPT_NAME']) == '/') {
    define('DIR', '');
} else {
    define('DIR', dirname($_SERVER['SCRIPT_NAME']));
}

define('CONTENT',       DIR.'/content');
define('PLUGINS',       CONTENT.'/plugins');
define('THEMES',        CONTENT.'/themes');
define('UPLOADS',       CONTENT.'/uploads');
