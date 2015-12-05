<?php
/**
 * This file is part of Rudolf.
 *
 * Represents an HTTP response.
 *
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package Rudolf\Http
 * @version 0.1
 */
namespace Rudolf\Http;

class ResponseMessages {

	/**
	 * Returns http code description.
	 * 
	 * @param int $code
	 * 
	 * @return array|bool
	 */
	public static function getMessages($code) {
		switch ($code) {
			case 100: return [
				_('Continue'),
				_('The request has been completed and the rest of the process can continue.')
			]; break;
			case 101: return [
				_('Switching Protocols'),
				_('When requesting a page, a browser might receive a statis code of 101, followed by an "Upgrade" header showing that the server is changing to a different version of HTTP.')
			]; break;
			case 200: return [
				_('OK'),
				_('Standard response for HTTP successful requests.')
			]; break;
			case 201: return [
				_('Created'),
				_('When new pages are created by posted form data or by a CGI process, this is confirmation that it worked.')
			]; break;
			case 202: return [
				_('Accepted'),
				_('The client\'s request was accepted, though not yet processed.')
			]; break;
			case 203: return [
				_('Non-Authoritative Information'),
				_('The information contained in the entity header is not from the original site, but from a third party server.')
			]; break;
			case 204: return [
				_('No Content'),
				_('If you click a link which has no target URL, this response is elicited by the server. It\'s silent and doesn\'t warn the user about anything.')
			]; break;
			case 205: return [
				_('Reset Content'),
				_('This allows the server to reset any content returned by a CGI.')
			]; break;
			case 206: return [
				_('Partial Content'),
				_('The requested file wasn\'t downloaded entirely. This is returned when the user presses the stop button before a page is loaded, for example.')
			]; break;
			case 300: return [
				_('Multiple Choices'),
				_('The requested address refers to more than one file. Depending on how the server is configured, you get an error or a choice of which page you want.')
			]; break;
			case 301: return [
				_('Moved Permanently'),
				_('If the server is set up properly it will automatically redirect the reader to the new location of the file.')
			]; break;
			case 302: return [
				_('Moved Temporarily'),
				_('Page has been moved temporarily, and the new URL is available. You should be sent there by the server.')
			]; break;
			case 303: return [
				_('See Other'),
				_('This is a "see other" SRC. Data is somewhere else and the GET method is used to retrieve it.')
			]; break;
			case 304: return [
				_('Not Modified'),
				_('If the request header includes an \'if modified since\' parameter, this code will be returned if the file has not changed since that date. Search engine robots may generate a lot of these.')
			]; break;
			case 305: return [
				_('Use Proxy'),
				_('The recipient is expected to repeat the request via the proxy.')
			]; break;
			case 400: return [
				_('Bad Request'),
				_('There is a syntax error in the request, and it is denied.')
			]; break;
			case 401: return [
				_('Unauthorized'),
				_('The request header did not contain the necessary authentication codes, and the client is denied access.')
			]; break;
			case 402: return [
				_('Payment Required'),
				_('Payment is required. This code is not yet in operation.')
			]; break;
			case 403: return [
				_('Forbidden'),
				_('The client is not allowed to see a certain file. This is also returned at times when the server doesn\'t want any more visitors.')
			]; break;
			case 404: return [
				_('Not Found'),
				_('The requested file was not found on the server. Possibly because it was deleted, or never existed before. Often caused by misspellings of URLs.')
			]; break;
			case 405: return [
				_('Method Not Allowed'),
				_('The method you are using to access the file is not allowed.')
			]; break;
			case 406: return [
				_('Not Acceptable'),
				_('The requested file exists but cannot be used as the client system doesn\'t understand the format the file is configured for.')
			]; break;
			case 407: return [
				_('Proxy Authentication Required'),
				_('The request must be authorised before it can take place.')
			]; break;
			case 408: return [
				_('Request Time-out'),
				_('The server took longer than its allowed time to process the request. Often caused by heavy net traffic.')
			]; break;
			case 409: return [
				_('Conflict'),
				_('Too many concurrent requests for a single file.')
			]; break;
			case 410: return [
				_('Gone'),
				_('The file used to be in this position, but is there no longer.')
			]; break;
			case 411: return [
				_('Length Required'),
				_('The request is missing its Content-Length header.')
			]; break;
			case 412: return [
				_('Precondition Failed'),
				_('A certain configuration is required for this file to be delivered, but the client has not set this up.')
			]; break;
			case 413: return [
				_('Request Entity Too Large'),
				_('The requested file was too big to process.')
			]; break;
			case 414: return [
				_('Request-URI Too Large'),
				_('The address you entered was overly long for the server.')
			]; break;
			case 415: return [
				_('Unsupported Media Type'),
				_('The filetype of the request is unsupported.')
			]; break;
			case 500: return [
				_('Internal Server Error'),
				_('The server encountered an unexpected condition which prevented it from fulfilling the request.')
			]; break;
			case 501: return [
				_('Not Implemented'),
				_('The server does not support the facility required.')
			]; break; 
			case 502: return [
				_('Bad Gateway'),
				_('The server you\'re trying to reach is sending back errors.')
			]; break;
			case 503: return [
				_('Service Unavailable'),
				_('The service or file that is being requested is not currently available.')
			]; break;
			case 504: return [
				_('Gateway Time-out'),
				_('The gateway has timed out. Like the 408 timeout error, but this one occurs at the gateway of the server.')
			]; break;
			case 505: return [
				_('HTTP Version not supported'),
				_('The HTTP protocol you are asking for is not supported.')
			]; break;
			
			default: return [
				_('Service Unavailable'),
				_('The service or file that is being requested is not currently available.')
			]; break;
		}
	}
}
