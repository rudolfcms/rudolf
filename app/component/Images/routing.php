<?php

use Rudolf\Component\Routing\Route;

$routeCollection->add('imageresizer/local', new Route(
    'content/cache/(<width>)/(<height>)/(<filename>)',
    'Rudolf\Component\Images\Resizer::runAsProxy',
    [
        'width' => '\d+',
        'height' => '\d+',
        'filename' => '(.*)'
    ]
));
