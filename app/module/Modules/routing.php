<?php

use Rudolf\Component\Routing\Route;

# admin
############################

// list

$collection->add('modules/admin', new Route(
    'admin/modules([\/])?',
    'Rudolf\Modules\Modules\Roll\Admin\Controller::redirectTo',
    [],
    ['target' => DIR.'/admin/modules/list']
));
$collection->add('modules/roll/admin', new Route(
    'admin/modules/list(/page/<page>)?',
    'Rudolf\Modules\Modules\Roll\Admin\Controller::getList',
    ['page' => '[1-9][0-9]*$'],
    ['page' => 0]
));

// module
$collection->add('modules/one/admin/switch', new Route(
    'admin/modules/switch/<slug>$',
    'Rudolf\Modules\Modules\One\Admin\SwitchController::switchStatus',
    ['slug' => '[A-z0-9-]+']
));
