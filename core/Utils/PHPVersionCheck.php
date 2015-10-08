<?php defined('LCMS') or die();
/**
 * This file is part of lcms.
 * 
 * Checks whether php version is compatible with the instance lcms
 * 
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package lcms
 * @version 0.1
 */

/**
 * Checks whether php version is compatible with LCMS
 * 
 * @param float $minimumVersionPHP
 * 
 * @return void
 */
function php_check_run($minimumVersionPHP) {
	$phpVersion = PHP_VERSION;
	
	if (version_compare($phpVersion, $minimumVersionPHP, '<')) {
		php_version_error($phpVersion, $minimumVersionPHP);
	}
}

/**
 * Displays an error if the PHP version is too low.
 * 
 * Calling this function kills execution immediately.
 * 
 * @param float $phpVersion
 * @param float $minimumVersionPHP
 * 
 * @return void
 */
function php_version_error($phpVersion, $minimumVersionPHP) {
	$pageTitle = 'Error to start the lcms!';
	$shortText = 'Your host needs to use PHP ' . $minimumVersionPHP . ' or higher to run this version of lcms!';
	$longText = 'To run lcms, you must upgrade your copy of PHP.';

	php_version_error_display($pageTitle, $shortText, $longText);

	die(1);
}

/**
 * Display user-friendly error
 * 
 * @param string $pageTitle
 * @param string $shortText
 * @param string $longText
 * 
 * @return void
 */
function php_version_error_display($pageTitle, $shortText, $longText) {
	header('Content-type: text/html; charset=UTF-8');
	header('Cache-control: none');
	header('Pragma: no-cache');

?><!DOCTYPE html>
<html>
<head>
	<title><?php echo $pageTitle;?></title>
	<style type="text/css">
		body {
			background: #f9f9f9;
			font-family: Arial, sans-serif;
			color: #444;
		}
		.centered {
			max-width: 500px;
			min-width: 200px;
			margin: 40px auto;
			padding: 15px;
			background: #fff;
			box-shadow: 1px 2px 3px #aaa;
		}
		h1 {
			font-weight: normal;
			margin: 5px 10px 20px;
		}
		p {
			margin: 10px;
			color: #555;
		}
	</style>
</head>
<body>
    <div class="centered">
    	<h1><?php echo $pageTitle;?></h1>
    	<p><?php echo $shortText;?></p>
    	<p><?php echo $longText;?></p>
    </div>
</body>
</html><?php

}
