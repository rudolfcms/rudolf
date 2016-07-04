<?php
use Rudolf\Component\Routing;
use Rudolf\Component\Modules\Module;

$module = new Module('dashboard');
$config = $module->getConfig();

# /foto(/page/3)
$collection->add('album/list', new Routing\Route(
    'foto(/page/<page>)?',
    'Rudolf\Modules\Albums\Roll\Controller::getList',
    ['page' => "[1-9][0-9]*$"],
    ['page' => 0]
));


# /foto/kategorie(/page/3)
$collection->add('album/category', new Routing\Route(
    'foto/kategorie/<slug>(/page/<page>)?',
    'Rudolf\Modules\Albums\Category\Controller::getCategory',
    ['slug' => "[a-z0-9]+(?:-[a-z0-9]+)*",
     'page' => "[1-9][0-9]*$"],
    ['page' => 0]
));

# /foto/2015/09/hello-world
$collection->add('album/one', new Routing\Route(
    'foto/<year>/<month>/<slug>',
    'Rudolf\Modules\Albums\One\Controller::getOne',
    ['year' => "[0-9]{4}",
     'month' => "(0[1-9]|[12]\d|3[01])",
     'slug' => "[a-z0-9-]*$"
        // (0[1-9]|[12]\d|3[01]) with 0, like 05
        // ([1-9]|[12]\d|3[01]) without 0, like 5
    ]
));


# admin
############################

$collection->add('albums/roll/admin', new Routing\Route(
    $config['admin_path'] . '/albums/list(/page/<page>)?',
    'Rudolf\Modules\Albums\Roll\Admin\Controller::getList',
    ['page' => "[1-9][0-9]*$"],
    ['page' => 0]
));

$collection->add('albums/one/admin/edit', new Routing\Route(
    $config['admin_path'] . '/albums/edit/<id>$',
    'Rudolf\Modules\Albums\One\Admin\Controller::edit',
    ['id' => "[1-9][0-9]*"]
));

$collection->add('albums/one/admin/del', new Routing\Route(
    $config['admin_path'] . '/albums/del/<id>$',
    'Rudolf\Modules\Albums\One\Admin\Controller::del',
    ['id' => "[1-9][0-9]*"]
));

$collection->add('albums/one/admin/add', new Routing\Route(
    $config['admin_path'] . '/albums/add$',
    'Rudolf\Modules\Albums\One\Admin\Controller::add'
));
