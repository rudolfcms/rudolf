<?php

/**
 * This file is part of lcms.
 * 
 * Error handler and logger
 * 
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package lcms\Utils
 * @version 0.1
 */

namespace lcms\Utils;

class ErrorHandler {

	private static $debug = false;
	private static $logPath;

	/**
	 * Set path to log file
	 * 
	 * @param string $path path to log file. If path is direcory, set file name as exception.log
	 * 
	 * @return void
	 */
	public static function setLogPath($path) {
		if(is_dir($path)) {
			$file = rtrim($path, '/') . '/exceptions.log';
			self::$logPath = $file;
		} else {
			$file = $path;
			self::$logPath = $path;
		}

		if(!is_file($file)) {
			fopen($file, 'w');
		}
	}

	/**
	 * Set app environment
	 * 
	 * @param string $env
	 * 
	 * @return void
	 */
	public static function setEnvironment($env) {
		if('debug' === $env) {
			self::$debug = true;
		}
	}

	/**
	* Error handler, passes flow over the exception logger with new ErrorException.
	* 
	* @param int $num
	* @param string $str error message
	* @param string $file
	* @param int $line
	* @param string $context
	* 
	* @return void
	*/
	public static function logError($num, $str, $file, $line, $context = false) {
		self::logException(new ErrorException($str, 0, $num, $file, $line), $context);
	}

	/**
	* Uncaught exception handler.
	* 
	* @param object $e
	* @param string $context
	* 
	* @return void
	*/
	public static function logException(Exception $e, $context = false) {
		if (self::$debug === true) {
			header('Cache-control: none');
			header('Pragma: no-cache');
			self::displayErrorUserFriendly(get_class($e), $e->getMessage(), $e->getFile(), $e->getLine(), $context);
		} else {
			self::saveEvent(get_class($e), $e->getMessage(), $e->getFile(), $e->getLine(), $context);
		}
	}

	/**
	* Checks for a fatal error, work around for set_error_handler not working on fatal errors.
	* 
	* @return void
	*/
	public static function checkForFatal() {
		$error = error_get_last();

		if ($error['type'] == E_ERROR) {
			self::logError( $error['type'], $error['message'], $error['file'], $error['line']);
			//exit();
		}
	}

	/**
	 * Save error to file
	 * 
	 * @param string $type
	 * @param string $message
	 * @param string $file
	 * @param int $line
	 * @param string $context
	 * 
	 * @return void
	 */
	private static function saveEvent($type, $message, $file, $line, $context) {
		$event = sprintf('[%1$s] %2$s: %3$s in [%4$s] on line %5$s',
			date('Y-m-d H:i:s'),
			$type,
			$message,
			$file,
			$line
		);
		file_put_contents(self::$logPath, $event . PHP_EOL, FILE_APPEND);
	}

	/**
	 * Display user-friendly error.
	 * 
	 * @param string $type
	 * @param string $message
	 * @param string $file
	 * @param int $line
	 * @param string $context
	 * 
	 * @return void
	 */
	private static function displayErrorUserFriendly($type, $message, $file, $line, $context) {
		?>
		<div style="margin:30px auto;font-family:Arial;padding:15px;box-shadow:1px 2px 3px #aaa;max-width:900px;">
			<h2 style="font-weight:normal">Exception Occured:</h2>
			<table style="min-width:100%">
				<tr style="background:#f5f5f5">
					<th style="width:100px">Type</th>
					<td style="padding:5px"><?=$type;?></td>
				</tr>
				<tr>
					<th>Message</th>
					<td style="padding:5px"><?=$message;?></td>
				</tr>
				<tr style="background:#f5f5f5">
					<th>File</th>
					<td style="padding:5px"><?=$file;?></td>
				</tr>
				<tr>
					<th>Line</th>
					<td style="padding:5px"><?=$line;?></td>
				</tr>
				<tr style="background:#f5f5f5">
					<th>Context</th>
					<td style="padding:5px"><pre><?php print_r($context);?></pre></td>
				</tr>
			</table>
		</div><?php 
	}
}
