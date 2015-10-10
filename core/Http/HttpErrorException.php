<?php

/**
 * This file is part of lcms.
 * 
 * Display error and send specific http code.
 * 
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package lcms\Http
 * @version 0.1
 */

namespace lcms\Http;

class HttpErrorException extends \Exception {

	/**
	 * @var string Exception message
	 */
	protected $message;
	
	/**
	 * @var int User-defined exception code
	 */
	protected $code;

	/**
	 * Constructor
	 * 
	 * @param string $message
	 * @param int $code
	 */
	 public function __construct($code = 404, $message, $text = false) {
		$message = ($message) ? $message : $this->httpResponseCode($code)[0];

		$this->text = ($text) ? $text : $this->httpResponseCode($code)[1];
		parent::__construct($message, $code);
	}

	public function __toString() {
		header('Content-type: text/html; charset=UTF-8');
		header('Cache-control: none');
		header('Pragma: no-cache');
		header($_SERVER["SERVER_PROTOCOL"].' '.$this->code .' '.$this->httpResponseCode($this->code)[0]);

		return $this->displayMessageHtml();
	}

	/**
	 * Displays an error message in string
	 * 
	 * @return string
	 */	
	private function displayMessageText() {
		return "{$this->message} [{$this->code}]\n";
	}

	/**
	 * Displays an error message in html
	 * 
	 * @return string
	 */
	private function displayMessageHtml() {
		$code = $this->code;
		$message = $this->message;
		$text = $this->text;
		$title = $code . ' - ' . $message;

		return '<!DOCTYPE html><html><meta charset="utf-8"><title>Error '.$title.'</title><style>body{background:#f9f9f9;font-family:Arial,sans-serif;color:#444}.c{max-width:500px;min-width:200px;margin:40px auto;padding:15px;background:#fff;box-shadow:1px 2px 3px #aaa}h1{font-weight:normal;margin:5px 10px 20px;}p{margin:10px;color:#555}.r{font-size:13px;text-align:right;font-style:italic;color:#aaa}</style><div class="c"><h1>'.$message.'</h1><p>Error '.$code.'</p><p>'.$text.'</p><p class="r">lcms</p></div>';
	}

	private function httpResponseCode($code) {
		switch ($code) {
            case 100: $text = ['Continue', 'The request has been completed and the rest of the process can continue.']; break;
            case 101: $text = ['Switching Protocols', 'When requesting a page, a browser might receive a statis code of 101, followed by an "Upgrade" header showing that the server is changing to a different version of HTTP.']; break;
            case 200: $text = ['OK', 'Standard response for HTTP successful requests.']; break;
            case 201: $text = ['Created', 'When new pages are created by posted form data or by a CGI process, this is confirmation that it worked.']; break;
            case 202: $text = ['Accepted', ' The client\'s request was accepted, though not yet processed.']; break;
            case 203: $text = ['Non-Authoritative Information', 'The information contained in the entity header is not from the original site, but from a third party server.']; break;
            case 204: $text = ['No Content', 'If you click a link which has no target URL, this response is elicited by the server. It\'s silent and doesn\'t warn the user about anything.']; break;
            case 205: $text = ['Reset Content', 'This allows the server to reset any content returned by a CGI.']; break;
            case 206: $text = ['Partial Content', 'The requested file wasn\'t downloaded entirely. This is returned when the user presses the stop button before a page is loaded, for example.']; break;
            case 300: $text = ['Multiple Choices', 'The requested address refers to more than one file. Depending on how the server is configured, you get an error or a choice of which page you want.']; break;
            case 301: $text = ['Moved Permanently', 'If the server is set up properly it will automatically redirect the reader to the new location of the file.']; break;
            case 302: $text = ['Moved Temporarily', 'Page has been moved temporarily, and the new URL is available. You should be sent there by the server.']; break;
            case 303: $text = ['See Other', 'This is a "see other" SRC. Data is somewhere else and the GET method is used to retrieve it.']; break;
            case 304: $text = ['Not Modified', 'If the request header includes an \'if modified since\' parameter, this code will be returned if the file has not changed since that date. Search engine robots may generate a lot of these.']; break;
            case 305: $text = ['Use Proxy', 'The recipient is expected to repeat the request via the proxy.']; break;
            case 400: $text = ['Bad Request', 'There is a syntax error in the request, and it is denied.']; break;
            case 401: $text = ['Unauthorized', 'The request header did not contain the necessary authentication codes, and the client is denied access.']; break;
            case 402: $text = ['Payment Required', 'Payment is required. This code is not yet in operation.']; break;
            case 403: $text = ['Forbidden', 'The client is not allowed to see a certain file. This is also returned at times when the server doesn\'t want any more visitors.']; break;
            case 404: $text = ['Not Found', 'The requested file was not found on the server. Possibly because it was deleted, or never existed before. Often caused by misspellings of URLs.']; break;
            case 405: $text = ['Method Not Allowed', 'The method you are using to access the file is not allowed.']; break;
            case 406: $text = ['Not Acceptable', 'The requested file exists but cannot be used as the client system doesn\'t understand the format the file is configured for.']; break;
            case 407: $text = ['Proxy Authentication Required', 'The request must be authorised before it can take place.']; break;
            case 408: $text = ['Request Time-out', 'The server took longer than its allowed time to process the request. Often caused by heavy net traffic.']; break;
            case 409: $text = ['Conflict', 'Too many concurrent requests for a single file.']; break;
            case 410: $text = ['Gone', 'The file used to be in this position, but is there no longer.']; break;
            case 411: $text = ['Length Required', 'The request is missing its Content-Length header.']; break;
            case 412: $text = ['Precondition Failed', 'A certain configuration is required for this file to be delivered, but the client has not set this up.']; break;
            case 413: $text = ['Request Entity Too Large', 'The requested file was too big to process.']; break;
            case 414: $text = ['Request-URI Too Large', 'The address you entered was overly long for the server.']; break;
            case 415: $text = ['Unsupported Media Type', 'The filetype of the request is unsupported.']; break;
            case 500: $text = ['Internal Server Error', 'The server encountered an unexpected condition which prevented it from fulfilling the request.']; break;
            case 501: $text = ['Not Implemented', 'The server does not support the facility required.']; break;
            case 502: $text = ['Bad Gateway', 'The server you\'re trying to reach is sending back errors.']; break;
            case 503: $text = ['Service Unavailable', 'The service or file that is being requested is not currently available.']; break;
            case 504: $text = ['Gateway Time-out', 'The gateway has timed out. Like the 408 timeout error, but this one occurs at the gateway of the server.']; break;
            case 505: $text = ['HTTP Version not supported', 'The HTTP protocol you are asking for is not supported.']; break;
            default:
                trigger_error('Unknown http status code ' . $code, E_USER_ERROR); 
                return $prev_code;
        }

        return $text;
	}
}
