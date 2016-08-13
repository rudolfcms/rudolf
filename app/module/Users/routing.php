<?php

use Rudolf\Component\Routing\Route;

$collection->add('user/login', new Route(
    'user/login(/redirect-to/<page>)?',
    'Rudolf\Modules\Users\One\Login\Controller::login',
    ['page' => '.*$'],
    ['page' => 'dashboard']
));

$collection->add('user', new Route(
    'user([\/])?',
    'Rudolf\Modules\Users\One\Admin\Profile\Controller::redirectTo',
    [],
    ['target' => DIR.'/user/profile']
));
$collection->add('user/profile', new Route(
    'user/profile',
    'Rudolf\Modules\Users\One\Admin\Profile\Controller::profile'
));
$collection->add('user/logout', new Route(
    'user/logout',
    'Rudolf\Modules\Users\One\Admin\Logout\Controller::logout'
));

# admin
############################

// list
$collection->add('users/admin', new Route(
    'admin/users([\/])?',
    'Rudolf\Modules\Users\Roll\Admin\Controller::redirectTo',
    [],
    ['target' => DIR.'/admin/users/list']
));
$collection->add('users/roll/admin', new Route(
    'admin/users/list(/page/<page>)?',
    'Rudolf\Modules\Users\Roll\Admin\Controller::getList',
    ['page' => '[1-9][0-9]*$'],
    ['page' => 0]
));
