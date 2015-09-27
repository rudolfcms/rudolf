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
require_once dirname(__FILE__) . '/includes/PHPVersionCheck.php';
php_check_run($required = 5.5);

// load defines
require_once __DIR__ . '/defines.php';

// load functions to log or disply errors
require_once CORE . '/includes/ErrorHandler.php';
ErrorHandler::setLogPath(CORE . '/log/errors.log');
ErrorHandler::setEnvironment(APP_ENV);
register_shutdown_function(array( 'ErrorHandler', 'check_for_fatal'));
set_error_handler(array('ErrorHandler', 'log_error'));
set_exception_handler(array('ErrorHandler', 'log_exception'));
ini_set('display_errors', 'off');

