<?php

use lcms\Routing;

$collection->add('index', new Routing\Route(
	'(page/<page>)?',
	'Modules\index\IndexController',
	array(
		'page' => "\d+"
	),
	array(
		'page' => 1
	)
));
