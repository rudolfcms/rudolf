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

use Rudolf\Utils\ErrorHandler,
	Rudolf\Plugins\PluginsManager,
	Rudolf\Modules\ModulesManager,
	Rudolf\Modules\ModulesRouting,
	Rudolf\Routing\RouteCollection,
	Rudolf\Routing\Router,
	Rudolf\Routing\FrontController;

// checks whether php version is compatible with the instance of Rudolf
require_once dirname(__FILE__) . '/core/Utils/PHPVersionCheck.php';
php_check_run($required = 5.3);

// load defines
require_once __DIR__ . '/defines.php';

// load class autolaoder
require_once ROOT . '/vendor/autoload.php';

$config = include CONFIG_ROOT . '/site.php';
define('FRONT_THEME', $config['front_theme']);
define('ADMIN_THEME', $config['admin_theme']);
define('ENV', $config['debug']);

// load functions to log or disply errors
$errorHandler = new ErrorHandler('/log/errors.log', ENV);
ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_NOTICE);
set_error_handler(array($errorHandler, 'logError'));
set_exception_handler(array($errorHandler, 'logException'));
register_shutdown_function(array($errorHandler, 'checkForFatal'));

setlocale(LC_ALL,'pl_PL.UTF8');
//setlocale(LC_ALL,'en_US.UTF8');
bindtextdomain('rudolf','./locale');
textdomain('rudolf');

// run extensions (plugins) menager
PluginsManager::run();

$routeCollection = new RouteCollection();

$modulesManager = new ModulesManager('/modules');
$modulesRouting = new ModulesRouting($modulesManager->getList(), $routeCollection, '/modules');
$routeCollection = $modulesRouting->addRoutes();

$router = new Router($_SERVER['REQUEST_URI'], DIR, $routeCollection);

$frontController = new FrontController($router);
$frontController->run();

