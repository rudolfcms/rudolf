<?php

use Rudolf\Component\Routing\Route;

# admin
############################

// list

$collection->add('appearance/admin', new Route(
    'admin/appearance([\/])?',
    'Rudolf\Modules\Appearance\Roll\Admin\Controller::redirectTo',
    [],
    ['target' => DIR.'/admin/appearance/list']
));
$collection->add('appearance/roll/admin', new Route(
    'admin/appearance/list(/page/<page>)?',
    'Rudolf\Modules\Appearance\Roll\Admin\Controller::getList',
    ['page' => '[1-9][0-9]*$'],
    ['page' => 0]
));

// switch
$collection->add('appearance/one/admin/switch', new Route(
    'admin/appearance/switch/<slug>$',
    'Rudolf\Modules\Appearance\Change\SwitchController::switchTheme',
    ['slug' => '[A-z0-9-]+']
));


// editor
$collection->add('appearance/editor', new Route(
    'admin/appearance/editor(/file/<file>)?',
    'Rudolf\Modules\Appearance\Editor\EditorController::editor',
    ['file' => '(?:[A-Za-z0-9+/]{4})*(?:[A-Za-z0-9+/]{2}==|[A-Za-z0-9+/]{3}=)?$']
));

// menu
$collection->add('appearance/menu', new Route(
    'admin/appearance/menu',
    'Rudolf\Modules\Appearance\Menu\MenuController::display'
));

// menu
$collection->add('appearance/menu/edit', new Route(
    'admin/appearance/menu/edit/<id>',
    'Rudolf\Modules\Appearance\Menu\EditController::edit',
    ['id' => '[1-9][0-9]*']
));

// menu
$collection->add('appearance/menu/del', new Route(
    'admin/appearance/menu/del/<id>',
    'Rudolf\Modules\Appearance\Menu\DelController::del',
    ['id' => '[1-9][0-9]*']
));

// menu
$collection->add('appearance/menu/add', new Route(
    'admin/appearance/menu/add?',
    'Rudolf\Modules\Appearance\Menu\AddController::add'
));
