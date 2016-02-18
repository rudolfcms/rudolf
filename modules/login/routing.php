<?php

$collection->add('user/login', new Rudolf\Routing\Route(
	'user/login(/redirect-to/<page>)?',
	'Rudolf\Modules\login\LoginController::login',
	array( // wyrazenia regularne dla parametrow
		'page' => ".*$"
	),
	array( // wartosci domyslne
		'page' => 'dashboard'
	),
	999
));

$collection->add('user/logout', new Rudolf\Routing\Route(
	'user/logout',
	'Rudolf\Modules\login\LoginController::logout',
	[],
	[],
	999
));