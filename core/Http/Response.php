<?php

/**
 * This file is part of lcms.
 * 
 * Represents an HTTP response.
 * 
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package lcms\Http
 * @version 0.1
 */

namespace lcms\Http;

class Response {

	 /**
	 * @var array Status codes translation table
	 */
	public static $statusTexts = array(
		100 => 'Continue',
		101 => 'Switching Protocols',
		200 => 'OK',
		201 => 'Created',
		202 => 'Accepted',
		203 => 'Non-Authoritative Information',
		204 => 'No Content',
		205 => 'Reset Content',
		206 => 'Partial Content',
		300 => 'Multiple Choices',
		301 => 'Moved Permanently',
		302 => 'Found',
		303 => 'See Other',
		304 => 'Not Modified',
		305 => 'Use Proxy',
		400 => 'Bad Request',
		401 => 'Unauthorized',
		402 => 'Payment Required',
		403 => 'Forbidden',
		404 => 'Not Found',
		405 => 'Method Not Allowed',
		406 => 'Not Acceptable',
		407 => 'Proxy Authentication Required',
		408 => 'Request Timeout',
		409 => 'Conflict',
		410 => 'Gone',
		411 => 'Length Required',
		412 => 'Precondition Failed',
		413 => 'Payload Too Large',
		414 => 'URI Too Long',
		415 => 'Unsupported Media Type',
		500 => 'Internal Server Error',
		501 => 'Not Implemented',
		502 => 'Bad Gateway',
		503 => 'Service Unavailable',
		504 => 'Gateway Timeout',
		505 => 'HTTP Version Not Supported'
	);

	/**
	 * Constructor
	 *
	 * @param mixed $content The response content, see setContent()
	 * @param int   $status  The response status code
	 * @param array $headers An array of response headers
	 *
	 * @throws \InvalidArgumentException When the HTTP status code is not valid
	 */
	public function __construct($content = '', $status = 200, $headers = array()) {
		$this->setContent($content);
		$this->setStatusCode($status);
		$this->headers = setHeaders($headers);
	}
}
