<?php
/**
 * This file is part of Rudolf.
 * 
 * Initiates the application.
 * 
 * @author Mikołaj Pich <m.pich@outlook.com>
 *
 * @version 0.1
 */
use Rudolf\Component\ErrorHandler\Run as ErrorHandler;
use Rudolf\Component\Logger\Logger;
use Rudolf\Component\Modules\ModulesHooks;
use Rudolf\Component\Modules\ModulesManager;
use Rudolf\Component\Modules\ModulesRouting;
use Rudolf\Component\Plugins\PluginsManager;
use Rudolf\Component\Routing\FrontController;
use Rudolf\Component\Routing\RouteCollection;
use Rudolf\Component\Routing\Router;

ob_start();

// checks whether php version is compatible with the instance of Rudolf
require_once dirname(__FILE__).'/component/Utils/PHPVersionCheck.php';
php_check_run($required = 5.3);

// load defines
require_once __DIR__.'/defines.php';

// load class autolaoder
require_once APP_ROOT.'/vendor/autoload.php';

// load page configuration
$config = include CONFIG_ROOT.'/site.php';
define('FRONT_THEME', $config['front_theme']);
define('ADMIN_THEME', $config['admin_theme']);
define('GENERAL_SITE_NAME', $config['general_name']);

$lang = 'pl_PL.UTF8';
putenv('LANG='.$lang);
setlocale(LC_ALL,  $lang);
//setlocale(LC_ALL,'en_US.UTF8');

$domain = 'rudolf';
bindtextdomain($domain, APP_ROOT.'/locale');
textdomain($domain);
bind_textdomain_codeset($domain, 'UTF-8');

// initialize logger
$logger = new Logger();

// register ErrorHandler
$errorHandler = new ErrorHandler();
$errorHandler->setEnvironment($config['debug']);
$errorHandler->setLogger($logger);
$errorHandler->register();

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
