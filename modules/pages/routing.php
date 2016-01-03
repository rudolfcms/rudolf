<?php

use Rudolf\Routing;

$collection->add('pages', new Routing\Route(
	'<page>',
	'Rudolf\Modules\pages\PagesController::page',
	array(
		'page' => "[a-z0-9-\/]*?(?<!\/)$" // without end slash
		//'page' => "[a-z0-9-\/]*?$" // with end slash
	)
));
