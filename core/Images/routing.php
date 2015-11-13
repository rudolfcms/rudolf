<?php

use lcms\Routing;

$collection->add('imageresizer', new Routing\Route(
	'imageresize/<width>/<height>/<url>',
	'lcms\Images\Resizer::init',
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
