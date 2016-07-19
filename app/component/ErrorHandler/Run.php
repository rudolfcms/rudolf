<?php
namespace Rudolf\Component\ErrorHandler;

class Run
{
	/**
	 * @var int Debug level
	 */
	private $debug;

	/**
	 * @var object
	 */
	private $logger;

	/**
	 * Constructor
	 * 
	 */
	public function __construct()
	{
		//error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_NOTICE);
		ini_set('display_errors', 1);
	}

	/**
	 * @param int $debug Debug level
	 */
	public function setEnvironment($debug)
	{
		$this->debug = $debug;
	}

	/**
	 * @param LoggerInterface $logger
	 */
	public function setLogger($logger)
	{
		$this->logger = $logger;
	}

	/**
	 * Register error handler
	 * 
	 * @return void
	 */
	public function register()
	{
		if (php_sapi_name() === 'cli') {
			$this->handler = new Handler\PlainTextHandler();
		} elseif ($this->debug > 0) {
			$this->handler = new Handler\DebugFriendlyHandler();
		} else {
			$this->handler = new Handler\UserFriendlyHandler();
		}

		set_error_handler([$this, 'handleError']);
		set_exception_handler([$this, 'handleException']);
		register_shutdown_function([$this, 'handleShutdown']);
	}

	/**
	 * Handle shutdown errors
	 * 
	 * @return void
	 */
	public function handleShutdown()
	{
		$e = error_get_last();
		if ($e && $this->isLevelFatal($e['type'])) {
			$this->handleError($e['type'], $e['message'], $e['file'], $e['line']);
		}
	}

	/**
	 * Handle errors
	 * 
	 * @return void
	 */
	public function handleError($level, $message, $file = null, $line = null)
	{
		$e = new \ErrorException($message, /*code*/ $level, /*severity*/ $level, $file, $line);
        $this->handleException($e);
	}

	/**
	 * Handle exceptions
	 * 
	 * @param Exception $e
	 * 
	 * @return void
	 */
	public function handleException($e)
	{
		ob_clean();
		$this->handler->handle($e);

		if ($this->logger) {
			$d = $this->handler->getDescription();
			$this->logger->critical($d['file'] .':'. $d['line'] .' '. $d['class'] .': '. $d['message']);
		}
		die();
	}

	/**
	 * Check if error is fatal error
	 *
 	 * @param int $level
     * @return bool
     */
    public static function isLevelFatal($level)
    {
        $errors = E_ERROR;
        $errors |= E_PARSE;
        $errors |= E_CORE_ERROR;
        $errors |= E_CORE_WARNING;
        $errors |= E_COMPILE_ERROR;
        $errors |= E_COMPILE_WARNING;

        return ($level & $errors) > 0;
    }
}
