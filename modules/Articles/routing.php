<?php

use Rudolf\Routing;

# /artykuly(/page/3)
$collection->add('article/list', new Routing\Route(
	'artykuly(/page/<page>)?',
	'Rudolf\Modules\Articles\Controller::getList',
	array( // wyrazenia regularne dla parametrow
		'page' => "[1-9][0-9]*$"
	),
	array( // wartosci domyslne
		'page' => 1
	)
));

# /artykuly/kategorie(/page/3)
$collection->add('article/category', new Routing\Route(
	'artykuly/kategorie/<slug>(/page/<page>)?',
	'Rudolf\Modules\Articles\Controller::getCategory',
	array( // wyrazenia regularne dla parametrow
		'slug' => "[a-z0-9]+(?:-[a-z0-9]+)*",
		'page' => "[1-9][0-9]*$"
	),
	array( // wartosci domyslne
		'page' => 0
	)
));

# /artykuly/2015/09/hello-world
$collection->add('article/one', new Routing\Route(
	'artykuly/<year>/<month>/<slug>',
	'Rudolf\Modules\Articles\Controller::getOne',
	array( // wyrazenia regularne dla parametrow
		'year' => "[0-9]{4}",
		'month' => "(0[1-9]|[12]\d|3[01])",
		'slug' => "[a-z0-9-]*$"
		// (0[1-9]|[12]\d|3[01]) with 0, like 05
		// ([1-9]|[12]\d|3[01]) without 0, like 5
	)
));

# /artykuly/2015/9/hello-world
/*
$collection->add('article/one', new Routing\Route(
	'Rudolf\Modules/<year>/<month>/<slug>',
	'Modules\Articles\Controller::one',
	array( // wyrazenia regularne dla parametrow
		'year' => "[0-9]{4}",
		'month' => "([1-9]|[12]\d|3[01])",
		'slug' => "\w+"
		// (0[1-9]|[12]\d|3[01]) with 0, like 05
		// ([1-9]|[12]\d|3[01]) without 0, like 5
	)
));
*/

# /feed/atom
$collection->add('articles/feed', new Routing\Route(
	'feed/<feed>$',
	'Rudolf\Modules\Articles\Controller::getFeed',
	array( // wyrazenia regularne dla parametrow
		'feed' => '[a-z0-9]+(?:-[a-z0-9]+)*'
	)
));