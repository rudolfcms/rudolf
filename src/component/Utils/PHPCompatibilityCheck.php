<?php

/**
 * Checks whether php version is compatible with Rudolf.
 *
 * @param float $minimumVersionPHP
 */
function php_compatibility_check($minimumVersionPHP)
{
    $phpVersion = PHP_VERSION;

    if (version_compare($phpVersion, $minimumVersionPHP, '<')) {
        php_compatibility_error($phpVersion, $minimumVersionPHP);
    }
}

/**
 * Displays an error if the PHP version is too low.
 *
 * Calling this function kills execution immediately.
 *
 * @param float $phpVersion
 * @param float $minimumVersionPHP
 */
function php_compatibility_error($phpVersion, $minimumVersionPHP)
{
    $pageTitle = 'Error to start the Rudolf!';
    $shortText = 'Your host needs to use PHP '.$minimumVersionPHP.' or higher to run this version of Rudolf!';
    $longText = 'To run Rudolf, you must upgrade your copy of PHP.';

    php_compatibility_error_display($pageTitle, $shortText, $longText);

    die(1);
}

/**
 * Display user-friendly error.
 *
 * @param string $pageTitle
 * @param string $shortText
 * @param string $longText
 */
function php_compatibility_error_display($pageTitle, $shortText, $longText)
{
    header('Content-type: text/html; charset=UTF-8');
    header('Cache-control: none');
    header('Pragma: no-cache'); ?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $pageTitle; ?></title>
    <style type="text/css">
        body {
            background: #f1f1f1;
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
        <h1><?php echo $pageTitle; ?></h1>
        <p><?php echo $shortText; ?></p>
        <p><?php echo $longText; ?></p>
    </div>
</body>
</html><?php
}
