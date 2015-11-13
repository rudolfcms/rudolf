<?php

$cacheDir = '.temp/imageresizer/';
//$filename = $width . 'x' . $height . '_' . md5($url);

if(!file_exists($cacheDir)) {
	mkdir($cacheDir, 0775);
}

define('FILE_CACHE_DIRECTORY', $cacheDir);
define('ALLOW_EXTERNAL', true);
define('ALLOW_ALL_EXTERNAL_SITES', true);
define('PNG_IS_TRANSPARENT', true);
define('DEBUG_ON', true);
define ('DEBUG_LEVEL', 3);

include 'core/Libs/timthumb.php';