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
    'Rudolf\Modules\Appearance\One\Admin\SwitchController::switchTheme',
    ['slug' => '[A-z0-9-]+']
));


// editor
$collection->add('appearance/one/admin/editor', new Route(
    'admin/appearance/editor(/file/<file>)?',
    'Rudolf\Modules\Appearance\One\Admin\EditorController::editor',
    ['file' => '(?:[A-Za-z0-9+/]{4})*(?:[A-Za-z0-9+/]{2}==|[A-Za-z0-9+/]{3}=)?$']
));
