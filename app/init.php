<?php

use Rudolf\Component\ErrorHandler\Run as ErrorHandler;
use Rudolf\Component\Logger\Logger;
use Rudolf\Component\Modules\Manager as ModulesManager;
use Rudolf\Component\Plugins\Manager as PluginsManager;
use Rudolf\Component\Routing\FrontController;
use Rudolf\Component\Routing\RouteCollection;
use Rudolf\Component\Routing\Router;

session_start();
ob_start();

require_once dirname(__FILE__).'/component/Utils/PHPCompatibilityCheck.php';
php_compatibility_check($required = 5.4);

// load defines
require_once __DIR__.'/defines.php';

// load class autolaoder
require_once APP_ROOT.'/vendor/autoload.php';

// load page configuration
$config = include CONFIG_ROOT.'/site.php';
define('FRONT_THEME', $config['front_theme']);
define('ADMIN_THEME', $config['admin_theme']);
define('GENERAL_SITE_NAME', $config['general_name']);

$lang = 'pl_PL';
// $lang = 'en_US';
$codeset = 'UTF-8';
putenv('LC_ALL='.$lang.'.'.$codeset);
putenv('LANG='.$lang.'.'.$codeset);
putenv('LANGUAGE='.$lang.'.'.$codeset);
setlocale(LC_ALL,  $lang.'.'.$codeset);

$domain = 'rudolf';
bindtextdomain($domain, APP_ROOT.'/locale');
bind_textdomain_codeset($domain, $codeset);
textdomain($domain);

// initialize logger
$logger = new Logger();

// register ErrorHandler
$errorHandler = new ErrorHandler();
$errorHandler->setEnvironment($config['debug']);
$errorHandler->setLogger($logger);
$errorHandler->register();

// routes
$routeCollection = new RouteCollection();

// plugins
$pluginsManager = new PluginsManager(PLUGINS_ROOT);
$pluginsManager->addRoutes($routeCollection);
$pluginsManager->addHooks();

// modules
$modulesManager = new ModulesManager(MODULES_ROOT);
$modulesManager->addRoutes($routeCollection);
$modulesManager->addHooks();

include APP_ROOT.'/component/Images/routing.php';

$router = new Router($_SERVER['REQUEST_URI'], DIR, $routeCollection);

$frontController = new FrontController($router);
$frontController->run();

ob_end_flush();
