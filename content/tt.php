<?php

$cacheDir = '../app/temp/imageresizer/';

if (!file_exists($cacheDir)) {
    mkdir($cacheDir, 0775);
}

define('FILE_CACHE_DIRECTORY', $cacheDir);
define('ALLOW_EXTERNAL', true);
define('ALLOW_ALL_EXTERNAL_SITES', true);
define('PNG_IS_TRANSPARENT', true);
define('DEBUG_ON', true);
define('DEBUG_LEVEL', 3);

include '../app/component/Libs/timthumb.php';
