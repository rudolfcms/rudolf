<?php

use lcms\Routing;

$collection->add('index', new Routing\Route(
	'(page/<page>)?',
	'Modules\index\IndexController',
	array(
		'page' => "[1-9][0-9]*$"
	),
	array(
		'page' => 0
	)
));
