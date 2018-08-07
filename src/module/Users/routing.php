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
    'Rudolf\Modules\Users\One\Admin\Profile\ShowController::profile'
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

// profile
$collection->add('users/edit', new Route(
    '/admin/users/edit/<id>$',
    'Rudolf\Modules\Users\One\Admin\Profile\EditController::edit',
    ['id' => '[1-9][0-9]*']
));

$collection->add('users/add', new Route(
    '/admin/users/add?',
    'Rudolf\Modules\Users\One\Admin\Profile\AddController::Add'
));

$collection->add('users/del', new Route(
    '/admin/users/del/<id>$',
    'Rudolf\Modules\Users\One\Admin\Profile\DelController::del',
    ['id' => '[1-9][0-9]*']
));
