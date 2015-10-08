<?php defined('LCMS') or die();
/**
 * This file is part of lcms.
 * 
 * Initiates the application.
 * 
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package lcms
 * @version 0.1
 */

// checks whether php version is compatible with the instance lcms
require_once dirname(__FILE__) . '/Utils/PHPVersionCheck.php';
php_check_run($required = 5.4);

// load defines
require_once __DIR__ . '/defines.php';

// load functions to log or disply errors
require_once LCORE . '/Utils/ErrorHandler.php';
ErrorHandler::setLogPath(LCORE . '/log/errors.log');
ErrorHandler::setEnvironment(LENV);
register_shutdown_function(array( 'ErrorHandler', 'checkForFatal'));
set_error_handler(array('ErrorHandler', 'logError'));
set_exception_handler(array('ErrorHandler', 'logException'));
ini_set('display_errors', 'off');

// load hooks class
require_once LCORE . '/Hooks/Hooks.php';

// load and run extensions (plugins) menager
require_once LCORE . '/Plugins/PluginsManager.php';
PluginsManager::run();

// load and run modules manager
require_once LCORE . '/Modules/ModulesManager.php';
ModulesManager::run();
