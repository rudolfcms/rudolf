<?php

/**
 * This file is part of lcms.
 * 
 * Initiates the application.
 * 
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package lcms
 * @version 0.1
 */

use lcms\Utils\ErrorHandler,
	lcms\Plugins\PluginsManager,
	lcms\Modules\ModulesManager,
	lcms\Modules\ModulesRouting,
	lcms\Routing\RouteCollection,
	lcms\Routing\Router,
	lcms\Routing\FrontController;

// checks whether php version is compatible with the instance lcms
require_once dirname(__FILE__) . '/Utils/PHPVersionCheck.php';
php_check_run($required = 5.3);

// load defines
require_once __DIR__ . '/defines.php';

// load class autolaoder
require_once LROOT . '/vendor/autoload.php';

// load functions to log or disply errors
ErrorHandler::setLogPath(LCORE . '/log/errors.log');
ErrorHandler::setEnvironment(LENV);
register_shutdown_function(array( 'ErrorHandler', 'checkForFatal'));
set_error_handler(array('ErrorHandler', 'logError'));
set_exception_handler(array('ErrorHandler', 'logException'));
//error_reporting(81);

// run extensions (plugins) menager
PluginsManager::run();

$routeCollection = new RouteCollection();

$modulesManager = new ModulesManager('/modules');
$modulesRouting = new ModulesRouting($modulesManager->getList(), $routeCollection, '/modules');
$routeCollection = $modulesRouting->addRoutes();

$router = new Router($_SERVER['REQUEST_URI'], LDIR, $routeCollection);

$frontController = new FrontController($router);
$frontController->invoke();
