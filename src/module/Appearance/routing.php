<?php

use Rudolf\Component\Routing\Route;

# admin
############################

// list

/** @var \Rudolf\Component\Routing\RouteCollection $collection */
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
    'admin/appearance/menu(/)?',
    'Rudolf\Modules\Appearance\Menu\MenuController::display'
));

$collection->add('appearance/menu/add-item', new Route(
    'admin/appearance/menu/add-item?',
    'Rudolf\Modules\Appearance\Menu\Item\ItemAddController::add'
));

$collection->add('appearance/menu/edit-item', new Route(
    'admin/appearance/menu/edit-item/<id>',
    'Rudolf\Modules\Appearance\Menu\Item\ItemEditController::edit',
    ['id' => '[1-9][0-9]*']
));

$collection->add('appearance/menu/del-item', new Route(
    'admin/appearance/menu/del-item/<id>',
    'Rudolf\Modules\Appearance\Menu\Item\ItemDelController::del',
    ['id' => '[1-9][0-9]*']
));

$collection->add('appearance/menu/add-type', new Route(
    'admin/appearance/menu/add-type?',
    'Rudolf\Modules\Appearance\Menu\Type\TypeAddController::add'
));

$collection->add('appearance/menu/edit-type', new Route(
    'admin/appearance/menu/edit-type/<id>',
    'Rudolf\Modules\Appearance\Menu\Type\TypeEditController::edit',
    ['id' => '[1-9][0-9]*']
));

$collection->add('appearance/menu/del-type', new Route(
    'admin/appearance/menu/del-type/<id>',
    'Rudolf\Modules\Appearance\Menu\Type\TypeDelController::del',
    ['id' => '[1-9][0-9]*']
));
