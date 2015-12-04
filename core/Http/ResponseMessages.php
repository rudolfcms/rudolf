<?php

namespace Rudolf\Http;

class ResponseMessages {

	public static function getMessages($code) {
		$array = array(
			100 => [
				_('Continue'),
				_('The request has been completed and the rest of the process can continue.')
			],
			101 => [
				_('Switching Protocols'),
				_('When requesting a page, a browser might receive a statis code of 101, followed by an "Upgrade" header showing that the server is changing to a different version of HTTP.')
			],
			200 => [
				_('OK'),
				_('Standard response for HTTP successful requests.')
			],
			201 => [
				_('Created'),
				_('When new pages are created by posted form data or by a CGI process, this is confirmation that it worked.')
			],
			202 => [
				_('Accepted'),
				_('The client\'s request was accepted, though not yet processed.')
			],
			203 => [
				_('Non-Authoritative Information'),
				_('The information contained in the entity header is not from the original site, but from a third party server.')
			],
			204 => [
				_('No Content'),
				_('If you click a link which has no target URL, this response is elicited by the server. It\'s silent and doesn\'t warn the user about anything.')
			],
			205 => [
				_('Reset Content'),
				_('This allows the server to reset any content returned by a CGI.')
			],
			206 => [
				_('Partial Content'),
				_('The requested file wasn\'t downloaded entirely. This is returned when the user presses the stop button before a page is loaded, for example.')
			],
			300 => [
				_('Multiple Choices'),
				_('The requested address refers to more than one file. Depending on how the server is configured, you get an error or a choice of which page you want.')
			],
			301 => [
				_('Moved Permanently'),
				_('If the server is set up properly it will automatically redirect the reader to the new location of the file.')
			],
			302 => [
				_('Moved Temporarily'),
				_('Page has been moved temporarily, and the new URL is available. You should be sent there by the server.')
			],
			303 => [
				_('See Other'),
				_('This is a "see other" SRC. Data is somewhere else and the GET method is used to retrieve it.')
			],
			304 => [
				_('Not Modified'),
				_('If the request header includes an \'if modified since\' parameter, this code will be returned if the file has not changed since that date. Search engine robots may generate a lot of these.')
			],
			305 => [
				_('Use Proxy'),
				_('The recipient is expected to repeat the request via the proxy.')
			],
			400 => [
				_('Bad Request'),
				_('There is a syntax error in the request, and it is denied.')
			],
			401 => [
				_('Unauthorized'),
				_('The request header did not contain the necessary authentication codes, and the client is denied access.')
			],
			402 => [
				_('Payment Required'),
				_('Payment is required. This code is not yet in operation.')
			],
			403 => [
				_('Forbidden'),
				_('The client is not allowed to see a certain file. This is also returned at times when the server doesn\'t want any more visitors.')
			],
			404 => [
				_('Not Found'),
				_('The requested file was not found on the server. Possibly because it was deleted, or never existed before. Often caused by misspellings of URLs.')
			],
			405 => [
				_('Method Not Allowed'),
				_('The method you are using to access the file is not allowed.')
			],
			406 => [
				_('Not Acceptable'),
				_('The requested file exists but cannot be used as the client system doesn\'t understand the format the file is configured for.')
			],
			407 => [
				_('Proxy Authentication Required'),
				_('The request must be authorised before it can take place.')
			],
			408 => [
				_('Request Time-out'),
				_('The server took longer than its allowed time to process the request. Often caused by heavy net traffic.')
			],
			409 => [
				_('Conflict'),
				_('Too many concurrent requests for a single file.')
			],
			410 => [
				_('Gone'),
				_('The file used to be in this position, but is there no longer.')
			],
			411 => [
				_('Length Required'),
				_('The request is missing its Content-Length header.')
			],
			412 => [
				_('Precondition Failed'),
				_('A certain configuration is required for this file to be delivered, but the client has not set this up.')
			],
			413 => [
				_('Request Entity Too Large'),
				_('The requested file was too big to process.')
			],
			414 => [
				_('Request-URI Too Large'),
				_('The address you entered was overly long for the server.')
			],
			415 => [
				_('Unsupported Media Type'),
				_('The filetype of the request is unsupported.')
			],
			500 => [
				_('Internal Server Error'),
				_('The server encountered an unexpected condition which prevented it from fulfilling the request.')
			],
			501 => [
				_('Not Implemented'),
				_('The server does not support the facility required.')
			],
			502 => [
				_('Bad Gateway'),
				_('The server you\'re trying to reach is sending back errors.')
			],
			503 => [
				_('Service Unavailable'),
				_('The service or file that is being requested is not currently available.')
			],
			504 => [
				_('Gateway Time-out'),
				_('The gateway has timed out. Like the 408 timeout error, but this one occurs at the gateway of the server.')
			],
			505 => [
				_('HTTP Version not supported'),
				_('The HTTP protocol you are asking for is not supported.')
			]
		);

		if(isset($array[$code])) {
			return $array[$code];
		}

		return false;
	}
}
