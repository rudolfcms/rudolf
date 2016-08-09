<?php

use Rudolf\Component\Routing\Route;

# /artykuly(/page/3)
$collection->add('articles/list', new Route(
    'artykuly(/page/<page>)?',
    'Rudolf\Modules\Articles\Roll\Controller::getList',
    ['page' => '[1-9][0-9]*$'],
    ['page' => 0]
));

# /artykuly/kategorie(/page/3)
$collection->add('articles/categories/one', new Route(
    'artykuly/kategorie/<slug>(/page/<page>)?',
    'Rudolf\Modules\Articles\Category\One\Controller::getCategory',
    ['slug' => '[a-z0-9]+(?:-[a-z0-9]+)*',
     'page' => '[1-9][0-9]*$', ],
    ['page' => 0]
));

# /artykuly/2015/09/hello-world
$collection->add('articles/one', new Route(
    'artykuly/<year>/<month>/<slug>(\/)?',
    'Rudolf\Modules\Articles\One\Controller::getOne',
    ['year' => '[0-9]{4}',
     'month' => "(0[1-9]|[12]\d|3[01])",
     'slug' => '[a-z0-9-]+',
        // (0[1-9]|[12]\d|3[01]) with 0, like 05
        // ([1-9]|[12]\d|3[01]) without 0, like 5
    ]
));

# /feed/atom
$collection->add('articles/feed', new Route(
    'feed/<feed>$',
    'Rudolf\Modules\Articles\Feed\Controller::getFeed',
    ['feed' => '[a-z0-9]+(?:-[a-z0-9]+)*']
));

# /artykuly/2015/9/hello-world
/*
$collection->add('articles/one', new Route(
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

// list

$collection->add('articles/admin', new Route(
    'admin/articles([\/])?',
    'Rudolf\Modules\Articles\Roll\Admin\Controller::redirectTo',
    [],
    ['target' => DIR.'/admin/articles/list']
));
$collection->add('articles/roll/admin', new Route(
    'admin/articles/list(/page/<page>)?',
    'Rudolf\Modules\Articles\Roll\Admin\Controller::getList',
    ['page' => '[1-9][0-9]*$'],
    ['page' => 0]
));

// categories
$collection->add('articles/categories/admin', new Route(
    'admin/articles/categories([\/])?',
    'Rudolf\Modules\Articles\Category\Roll\Admin\Controller::redirectTo',
    [],
    ['target' => DIR.'/admin/articles/categories/list']
));
$collection->add('articles/categories/roll/admin', new Route(
    'admin/articles/categories/list(/page/<page>)?',
    'Rudolf\Modules\Articles\Category\Roll\Admin\Controller::getList',
    ['page' => '[1-9][0-9]*$'],
    ['page' => 0]
));
$collection->add('articles/categories/one/admin/edit', new Route(
    'admin/articles/categories/edit/<id>$',
    'Rudolf\Modules\Articles\Category\One\Admin\EditController::edit',
    ['id' => '[1-9][0-9]*']
));
$collection->add('articles/categories/one/admin/add', new Route(
    'admin/articles/categories/add$',
    'Rudolf\Modules\Articles\Category\One\Admin\AddController::add'
));
$collection->add('articles/categories/one/admin/del', new Route(
    'admin/articles/categories/del/<id>$',
    'Rudolf\Modules\Articles\Category\One\Admin\DelController::del',
    ['id' => '[1-9][0-9]*']
));

// article
$collection->add('articles/one/admin/edit', new Route(
    'admin/articles/edit/<id>$',
    'Rudolf\Modules\Articles\One\Admin\EditController::edit',
    ['id' => '[1-9][0-9]*']
));

$collection->add('articles/one/admin/del', new Route(
    'admin/articles/del/<id>$',
    'Rudolf\Modules\Articles\One\Admin\DelController::del',
    ['id' => '[1-9][0-9]*']
));

$collection->add('articles/one/admin/add', new Route(
    'admin/articles/add$',
    'Rudolf\Modules\Articles\One\Admin\AddController::add'
));
