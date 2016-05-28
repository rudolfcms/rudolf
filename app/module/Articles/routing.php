<?php

use Rudolf\Component\Routing;

$module = new \Rudolf\Component\Modules\Module('dashboard');
$config = $module->getConfig();

# /artykuly(/page/3)
$collection->add('article/list', new Routing\Route(
	'artykuly(/page/<page>)?',
	'Rudolf\Modules\Articles\Roll\Controller::getList',
	['page' => "[1-9][0-9]*$"],
	['page' => 0]
));


# /artykuly/kategorie(/page/3)
$collection->add('article/category', new Routing\Route(
	'artykuly/kategorie/<slug>(/page/<page>)?',
	'Rudolf\Modules\Articles\Category\Controller::getCategory',
	['slug' => "[a-z0-9]+(?:-[a-z0-9]+)*",
	 'page' => "[1-9][0-9]*$"],
	['page' => 0]
));

# /artykuly/2015/09/hello-world
$collection->add('article/one', new Routing\Route(
	'artykuly/<year>/<month>/<slug>(\/)?',
	'Rudolf\Modules\Articles\One\Controller::getOne',
	['year' => "[0-9]{4}",
	 'month' => "(0[1-9]|[12]\d|3[01])",
	 'slug' => "[a-z0-9-]+"
		// (0[1-9]|[12]\d|3[01]) with 0, like 05
		// ([1-9]|[12]\d|3[01]) without 0, like 5
	]
));

# /feed/atom
$collection->add('articles/feed', new Routing\Route(
	'feed/<feed>$',
	'Rudolf\Modules\Articles\Feed\Controller::getFeed',
	['feed' => '[a-z0-9]+(?:-[a-z0-9]+)*']
));

# /artykuly/2015/9/hello-world
/*
$collection->add('article/one', new Routing\Route(
	'Rudolf\Modules/<year>/<month>/<slug>',
	'Modules\Articles\Controller::one',
	[
		'year' => "[0-9]{4}",
		'month' => "([1-9]|[12]\d|3[01])",
		'slug' => "\w+"
		// (0[1-9]|[12]\d|3[01]) with 0, like 05
		// ([1-9]|[12]\d|3[01]) without 0, like 5
	]
));
*/

# admin
############################


$collection->add('articles/roll/admin', new Routing\Route(
	$config['admin_path'] . '/articles/list(/page/<page>)?',
	'Rudolf\Modules\Articles\Roll\Admin\Controller::getList',
	['page' => "[1-9][0-9]*$"],
	['page' => 0]
));

$collection->add('articles/one/admin/edit', new Routing\Route(
	$config['admin_path'] . '/articles/edit/<id>$',
	'Rudolf\Modules\Articles\One\Admin\Controller::edit',
	['id' => "[1-9][0-9]*"]
));

$collection->add('articles/one/admin/add', new Routing\Route(
	$config['admin_path'] . '/articles/add$',
	'Rudolf\Modules\Articles\One\Admin\Controller::add'
));
