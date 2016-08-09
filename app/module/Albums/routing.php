<?php

use Rudolf\Component\Routing\Route;

# /foto(/page/3)
$collection->add('album/list', new Route(
    'foto(/page/<page>)?',
    'Rudolf\Modules\Albums\Roll\Controller::getList',
    ['page' => '[1-9][0-9]*$'],
    ['page' => 0]
));

# /foto/kategorie(/page/3)
$collection->add('album/category', new Route(
    'foto/kategorie/<slug>(/page/<page>)?',
    'Rudolf\Modules\Albums\Category\One\Controller::getCategory',
    ['slug' => '[a-z0-9]+(?:-[a-z0-9]+)*',
     'page' => '[1-9][0-9]*$', ],
    ['page' => 0]
));

# /foto/2015/09/hello-world
$collection->add('album/one', new Route(
    'foto/<year>/<month>/<slug>',
    'Rudolf\Modules\Albums\One\Controller::getOne',
    ['year' => '[0-9]{4}',
     'month' => "(0[1-9]|[12]\d|3[01])",
     'slug' => '[a-z0-9-]*$',
        // (0[1-9]|[12]\d|3[01]) with 0, like 05
        // ([1-9]|[12]\d|3[01]) without 0, like 5
    ]
));

# admin
############################

$collection->add('albums/admin', new Route(
    'admin/albums([\/])?',
    'Rudolf\Modules\Albums\Roll\Admin\Controller::redirectTo',
    [],
    ['target' => DIR.'/admin/albums/list']
));

$collection->add('albums/roll/admin', new Route(
    'admin/albums/list(/page/<page>)?',
    'Rudolf\Modules\Albums\Roll\Admin\Controller::getList',
    ['page' => '[1-9][0-9]*$'],
    ['page' => 0]
));

// categories
$collection->add('albums/categories/admin', new Route(
    'admin/albums/categories([\/])?',
    'Rudolf\Modules\Albums\Category\Roll\Admin\Controller::redirectTo',
    [],
    ['target' => DIR.'/admin/albums/categories/list']
));
$collection->add('albums/categories/roll/admin', new Route(
    'admin/albums/categories/list(/page/<page>)?',
    'Rudolf\Modules\Albums\Category\Roll\Admin\Controller::getList',
    ['page' => '[1-9][0-9]*$'],
    ['page' => 0]
));
$collection->add('albums/categories/one/admin/edit', new Route(
    'admin/albums/categories/edit/<id>$',
    'Rudolf\Modules\Albums\Category\One\Admin\EditController::edit',
    ['id' => '[1-9][0-9]*']
));
$collection->add('albums/categories/one/admin/add', new Route(
    'admin/albums/categories/add$',
    'Rudolf\Modules\Albums\Category\One\Admin\AddController::add'
));
$collection->add('albums/categories/one/admin/del', new Route(
    'admin/albums/categories/del/<id>$',
    'Rudolf\Modules\Albums\Category\One\Admin\DelController::del',
    ['id' => '[1-9][0-9]*']
));

// one
$collection->add('albums/one/admin/edit', new Route(
    'admin/albums/edit/<id>$',
    'Rudolf\Modules\Albums\One\Admin\EditController::edit',
    ['id' => '[1-9][0-9]*']
));

$collection->add('albums/one/admin/del', new Route(
    'admin/albums/del/<id>$',
    'Rudolf\Modules\Albums\One\Admin\DelController::del',
    ['id' => '[1-9][0-9]*']
));

$collection->add('albums/one/admin/add', new Route(
    'admin/albums/add$',
    'Rudolf\Modules\Albums\One\Admin\AddController::add'
));
