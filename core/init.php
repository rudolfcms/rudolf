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

// checks whether php version is compatible with the instance of lcms
require_once dirname(__FILE__) . '/Utils/PHPVersionCheck.php';
php_check_run($required = 5.3);

// load defines
require_once __DIR__ . '/defines.php';

// load class autolaoder
require_once LROOT . '/vendor/autoload.php';

// load functions to log or disply errors
$errorHandler = new ErrorHandler('/log/errors.log', LENV);
ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_NOTICE);
set_error_handler(array($errorHandler, 'logError'));
set_exception_handler(array($errorHandler, 'logException'));
register_shutdown_function(array($errorHandler, 'checkForFatal'));

setlocale(LC_ALL,'pl_PL.UTF8');
//setlocale(LC_ALL,'en_US.UTF8');
bindtextdomain('lcms','./locale');
textdomain('lcms');

$config = include LCONFIG_ROOT . '/site.php';
define('FRONT_THEME', $config['front_theme']);
define('ADMIN_THEME', $config['admin_theme']);
define('LENV', $config['debug']);

// run extensions (plugins) menager
PluginsManager::run();

$routeCollection = new RouteCollection();

$modulesManager = new ModulesManager('/modules');
$modulesRouting = new ModulesRouting($modulesManager->getList(), $routeCollection, '/modules');
$routeCollection = $modulesRouting->addRoutes();

$router = new Router($_SERVER['REQUEST_URI'], LDIR, $routeCollection);

$frontController = new FrontController($router);
$frontController->run();

