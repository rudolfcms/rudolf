<?php

$collection->add('login', new Rudolf\Routing\Route(
	'login(/redirect-to/<page>)?',
	'Rudolf\Modules\login\LoginController::form',
	array( // wyrazenia regularne dla parametrow
		'page' => "[1-9][0-9]*$"
	),
	array( // wartosci domyslne
		'page' => 'dashboard'
	)
));