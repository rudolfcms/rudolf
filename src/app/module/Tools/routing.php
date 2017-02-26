<?php

use Rudolf\Component\Routing\Route;

// list

$collection->add('tools/admin', new Route(
    'admin/tools([\/])?',
    'Rudolf\Modules\Tools\Admin\Roll\Controller::redirectTo',
    [],
    ['target' => DIR.'/admin/tools/list']
));
$collection->add('tools/admin/list', new Route(
    'admin/tools/list(/page/<page>)?',
    'Rudolf\Modules\Tools\Admin\Roll\Controller::getList',
    ['page' => '[1-9][0-9]*$'],
    ['page' => 0]
));

$collection->add('tools/admin/db-dump', new Route(
    'admin/tools/db-dump$',
    'Rudolf\Modules\Tools\Admin\One\DatabaseDump\Controller::show',
    ['id' => '[1-9][0-9]*']
));
