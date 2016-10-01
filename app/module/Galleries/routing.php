<?php

use Rudolf\Component\Routing\Route;

$collection->add('galleries/admin', new Route(
    'admin/galleries([\/])?',
    'Rudolf\Modules\Galleries\Roll\Admin\Controller::redirectTo',
    [],
    ['target' => DIR.'/admin/galleries/list']
));

$collection->add('galleries/roll/admin', new Route(
    'admin/galleries/list(/page/<page>)?',
    'Rudolf\Modules\Galleries\Roll\Admin\Controller::getList',
    ['page' => '[1-9][0-9]*$'],
    ['page' => 0]
));

// gallery
$collection->add('galleries/one/admin/edit', new Route(
    'admin/galleries/edit/<id>$',
    'Rudolf\Modules\Galleries\One\Admin\EditController::edit',
    ['id' => '[1-9][0-9]*']
));

$collection->add('galleries/one/admin/del', new Route(
    'admin/galleries/del/<id>$',
    'Rudolf\Modules\Galleries\One\Admin\DelController::del',
    ['id' => '[1-9][0-9]*']
));

$collection->add('galleries/one/admin/add', new Route(
    'admin/galleries/add$',
    'Rudolf\Modules\Galleries\One\Admin\AddController::add'
));
