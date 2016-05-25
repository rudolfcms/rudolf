<?php
/**
 * This file is part of Rudolf.
 * 
 * Error handler and logger
 * 
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package Rudolf\Component\Logger
 * @version 0.1
 */

namespace Rudolf\Component\Logger;

class DisplayError {

	/**
	 * Displays an error message in html
	 * 
	 * @return string
	 */
	public static function displayMessageFatal($code, $message, $text) {
		$code = $code;
		$message = _($message);
		$text = $text;
		$error = _('Code') . ' ' . $code;
		$title = $error . ' - ' . $message;

		return 
		'<!DOCTYPE html>'.
			'<meta charset="utf-8">'.
			'<title>'.$title.'</title>'.
			'<style>'.
				'body{background:#f1f1f1;font-family:Arial,sans-serif;color:#444}.c{max-width:500px;min-width:200px;margin:40px auto;padding:15px;background:#fff;box-shadow:1px 2px 3px #aaa}h1{font-weight:normal;margin:5px 10px 20px;}p{margin:10px;color:#555}.r{font-size:13px;text-align:right;font-style:italic;color:#aaa}'.
			'</style>'.
			
			'<div class="c">'.
			'<h1>'.$message.'</h1>'.
			'<p>'.$error.'</p>'.
			'<p>'.$text.'</p>'.
			'<p class="r">Rudolf</p>'.
			'</div>';
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
	public static function displayMessageError($type, $message, $file, $line) {
			header('Cache-control: none');
			header('Pragma: no-cache');
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
			</table>
		</div><?php 
	}
}
