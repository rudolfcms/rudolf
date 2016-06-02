<?php

use Rudolf\Component\Routing;

$collection->add('imageresizer', new Routing\Route(
    'imageresize/<width>/<height>/<url>',
    'Rudolf\Images\Resizer::init',
    array(
        'width' => '\d+',
        'height' => '\d+',
        'url' => '(.*+)'
    ),
    array(
        'width' => 100,
        'height' => 100
    )
));
