<?php

use lcms\Routing;

# /artykuly(/page/3)
$collection->add('article/list', new Routing\Route(
	'artykuly(/page/<page>)?',
	'Modules\articles\ArticlesController::index',
	array( // wyrazenia regularne dla parametrow
		'page' => "\d+"
	),
	array( // wartosci domyslne
		'page' => 1
	)
));

# /artykuly/2015/09/hello-world
$collection->add('article/one', new Routing\Route(
	'artykuly/<year>/<month>/<slug>',
	'Modules\articles\ArticlesController::one',
	array( // wyrazenia regularne dla parametrow
		'year' => "[0-9]{4}",
		'month' => "(0[1-9]|[12]\d|3[01])",
		'slug' => "\w+"
		// (0[1-9]|[12]\d|3[01]) with 0, like 05
		// ([1-9]|[12]\d|3[01]) without 0, like 5
	)
));

# /artykuly/2015/9/hello-world
/*
$collection->add('article/one', new Routing\Route(
	'artykuly/<year>/<month>/<slug>',
	'Modules\articles\ArticlesController::one',
	array( // wyrazenia regularne dla parametrow
		'year' => "[0-9]{4}",
		'month' => "([1-9]|[12]\d|3[01])",
		'slug' => "\w+"
		// (0[1-9]|[12]\d|3[01]) with 0, like 05
		// ([1-9]|[12]\d|3[01]) without 0, like 5
	)
));
*/