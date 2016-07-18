<?php
/**
 * This file is part of Rudolf.
 * 
 * Initiates the application.
 * 
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package Rudolf
 * @version 0.1
 */

use Rudolf\Component\Logger\ErrorHandler;
use Rudolf\Component\Modules\ModulesHooks;
use Rudolf\Component\Modules\ModulesManager;
use Rudolf\Component\Modules\ModulesRouting;
use Rudolf\Component\Plugins\PluginsManager;
use Rudolf\Component\Routing\FrontController;
use Rudolf\Component\Routing\RouteCollection;
use Rudolf\Component\Routing\Router;
ob_start();

// checks whether php version is compatible with the instance of Rudolf
require_once dirname(__FILE__) . '/component/Utils/PHPVersionCheck.php';
php_check_run($required = 5.3);

// load defines
require_once __DIR__ . '/defines.php';

// load class autolaoder
require_once APP_ROOT . '/vendor/autoload.php';

// load page configuration
$config = include CONFIG_ROOT . '/site.php';
define('FRONT_THEME', $config['front_theme']);
define('ADMIN_THEME', $config['admin_theme']);
define('GENERAL_SITE_NAME', $config['general_name']);
define('ENV', $config['debug']);

// set locale
$lang = 'pl_PL.UTF8';
putenv('LANG='.$lang);
setlocale(LC_ALL, $lang);
//setlocale(LC_ALL,'en_US.UTF8');
$domain = 'rudolf';
bindtextdomain($domain, APP_ROOT . '/locale');
textdomain($domain);

// load functions to log or disply errors
$errorHandler = new ErrorHandler();
ini_set('display_errors', 0);
error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_NOTICE);
set_error_handler(array($errorHandler, 'errorHandler'));
set_exception_handler(array($errorHandler, 'exceptionHandler'));
register_shutdown_function(array($errorHandler, 'shutdown'));

// run extensions (plugins) menager
PluginsManager::run();

$modulesManager = new ModulesManager(MODULES_ROOT);
$modulesHooks = new ModulesHooks($modulesManager->getList(), MODULES_ROOT);
$modulesHooks->addHooks();

$routeCollection = new RouteCollection();

$modulesRouting = new ModulesRouting($modulesManager->getList(), $routeCollection, MODULES_ROOT);
$routeCollection = $modulesRouting->addRoutes();

$router = new Router($_SERVER['REQUEST_URI'], DIR, $routeCollection);

$frontController = new FrontController($router);
$frontController->run();

ob_end_flush();
