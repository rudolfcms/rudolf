<?php
/**
 * This file is part of Rudolf.
 *
 * Display error and send specific http code.
 *
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package Rudolf\Http
 * @version 0.1
 */

namespace Rudolf\Http;

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
	 public function __construct($code = 404, $message = '', $text = false) {
	 	$texts = ResponseMessages::getMessages($code);

		$message = ($message) ? $message : $texts[0];

		$this->text = ($text) ? $text : $texts[1];
		
		parent::__construct($message, $code);
	}

	public function __toString() {
		try {
			$response = new Response($this->displayMessageHtml(), $this->code);
			$response->setHeader(['cache-Control', 'no-cache, must-revalidate']);

			return $response->send();
		} catch (\InvalidArgumentException $e) {
			die($e->getMessage());
		}
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
		$message = _($this->message);
		$text = $this->text;
		$error = _('Code') . ' ' . $code;
		$title = $error . ' - ' . $message;

		return '<!DOCTYPE html><html><meta charset="utf-8"><title>'.$title.'</title><style>body{background:#f1f1f1;font-family:Arial,sans-serif;color:#444}.c{max-width:500px;min-width:200px;margin:40px auto;padding:15px;background:#fff;box-shadow:1px 2px 3px #aaa}h1{font-weight:normal;margin:5px 10px 20px;}p{margin:10px;color:#555}.r{font-size:13px;text-align:right;font-style:italic;color:#aaa}</style><div class="c"><h1>'.$message.'</h1><p>'.$error.'</p><p>'.$text.'</p><p class="r">lcms</p></div>';
	}
}
