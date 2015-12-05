<?php
/**
 * This file is part of Rudolf.
 * 
 * Error handler.
 * 
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package Rudolf\Logger
 * @version 0.1
 */

namespace Rudolf\Logger;
use \Rudolf\Http\ResponseMessages,
	\Rudolf\Http\Response;

class ErrorHandler {
	
	/**
	 * Log error
	 * 
	 * @param int $num Error type number
	 * @param string $str Error message
	 * @param string $file
	 * @param int $line
	 * 
	 * @return void
	 */
	public function errorHandler($num, $str, $file, $line) {
		// log error
		$logger = new Logger('errors', $this->errorType($num), $str, $file, $line);
		$logger->save();
	}

	/**
	 * Catch exception
	 * 
	 * @param Exception $e
	 * 
	 * @return void
	 */
	public function exceptionHandler($e) {
		$code = ($e->getCode()) ? $e->getCode() : 503;
		$logFile = (404 === $code) ? 'error404' : 'exceptions';

		if(400 !== $code or 404 !== $code or 500 !== $code or 503 !== $code) $code = 503;

		// log exception
		$logger = new Logger($logFile, get_class($e), $e->getMessage(), $e->getFile(), $e->getLine());
		$logger->save();

		// display message
		die($this->showMessage($code));
	}
	
	/**
	 * Shutdown function
	 * 
	 * @return void
	 */
	public function shutdown() {
		$e = error_get_last();

		if (E_COMPILE_ERROR === $e['type']) {
			$log = new Logger('compile', $this->errorType($e['type']), $e['message'], $e['file'], $e['line']);
			$log->save();
			
			die($this->showMessage(503));
		}
	}

	/**
	 * Prepare user-friendly message
	 * 
	 * @param int $code
	 * 
	 * @return string
	 */
	private function showMessage($code = 503) {
		try {
			$texts = ResponseMessages::getMessages($code);
			$message = $texts[0];
			$text = $texts[1];

			$response = new Response(DisplayError::displayMessageFatal($code, $message, $text), $code);
			$response->setHeader(['cache-Control', 'no-cache, must-revalidate']);

			return $response->send();
		} catch (\InvalidArgumentException $e) {
			die($e->getMessage());
		}
	}

	public function errorType($type) {
		switch($type) {
			case E_ERROR: // 1 //
				return 'E_ERROR';
			case E_WARNING: // 2 //
				return 'E_WARNING';
			case E_PARSE: // 4 //
				return 'E_PARSE';
			case E_NOTICE: // 8 //
				return 'E_NOTICE';
			case E_CORE_ERROR: // 16 //
				return 'E_CORE_ERROR';
			case E_CORE_WARNING: // 32 //
				return 'E_CORE_WARNING';
			case E_COMPILE_ERROR: // 64 //
				return 'E_COMPILE_ERROR';
			case E_COMPILE_WARNING: // 128 //
				return 'E_COMPILE_WARNING';
			case E_USER_ERROR: // 256 //
				return 'E_USER_ERROR';
			case E_USER_WARNING: // 512 //
				return 'E_USER_WARNING';
			case E_USER_NOTICE: // 1024 //
				return 'E_USER_NOTICE';
			case E_STRICT: // 2048 //
				return 'E_STRICT';
			case E_RECOVERABLE_ERROR: // 4096 //
				return 'E_RECOVERABLE_ERROR';
			case E_DEPRECATED: // 8192 //
				return 'E_DEPRECATED';
			case E_USER_DEPRECATED: // 16384 //
				return 'E_USER_DEPRECATED';
		}
		return "";
	}
}
