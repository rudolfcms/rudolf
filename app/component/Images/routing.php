<?php

use Rudolf\Component\Routing\Route;

$routeCollection->add('imageresizer/local', new Route(
    'content/cache/<width>/<height>/<src>',
    'Rudolf\Component\Images\Resizer::runAsProxy',
    [
        'width' => '\d+',
        'height' => '\d+',
        'src' => '(?:[A-Za-z0-9+/]{4})*(?:[A-Za-z0-9+/]{2}==|[A-Za-z0-9+/]{3}=)?$',
    ]
));
