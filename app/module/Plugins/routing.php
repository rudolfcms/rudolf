<?php

use Rudolf\Component\Routing\Route;

# admin
############################

// list

$collection->add('plugins/admin', new Route(
    'admin/plugins([\/])?',
    'Rudolf\Modules\Plugins\Roll\Admin\Controller::redirectTo',
    [],
    ['target' => DIR.'/admin/plugins/list']
));
$collection->add('plugins/roll/admin', new Route(
    'admin/plugins/list(/page/<page>)?',
    'Rudolf\Modules\Plugins\Roll\Admin\Controller::getList',
    ['page' => '[1-9][0-9]*$'],
    ['page' => 0]
));

// module
$collection->add('plugins/one/admin/switch', new Route(
    'admin/plugins/switch/<slug>$',
    'Rudolf\Modules\Plugins\One\Admin\SwitchController::switchStatus',
    ['slug' => '[A-z0-9-]+']
));
