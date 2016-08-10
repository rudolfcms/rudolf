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
