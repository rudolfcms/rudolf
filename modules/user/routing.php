<?php

$module = new \Rudolf\Modules\Module('dashboard');
$config = $module->getConfig();

$collection->add('user/login', new Rudolf\Routing\Route(
	'user/login(/redirect-to/<page>)?',
	'Rudolf\Modules\user\LoginController::login',
	array( // wyrazenia regularne dla parametrow
		'page' => ".*$"
	),
	array( // wartosci domyslne
		'page' => 'dashboard'
	)
));

$collection->add('user/logout', new Rudolf\Routing\Route(
	'user/logout',
	'Rudolf\Modules\user\LoginController::logout'
));


$collection->add('user/profile', new Rudolf\Routing\Route(
	'user',
	'Rudolf\Modules\user\UserController::profile'
));
