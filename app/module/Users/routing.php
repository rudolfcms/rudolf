<?php

use Rudolf\Component\Routing\Route;

$collection->add('user/login', new Route(
    'user/login(/redirect-to/<page>)?',
    'Rudolf\Modules\Users\Login\Controller::login',
    ['page' => '.*$'],
    ['page' => 'dashboard']
));

$collection->add('user', new Route(
    'user([\/])?',
    'Rudolf\Modules\Users\Profile\Controller::redirectTo',
    [],
    ['target' => DIR.'/user/profile']
));
$collection->add('user/logout', new Route(
    'user/logout',
    'Rudolf\Modules\Users\Login\Controller::logout'
));
$collection->add('user/profile', new Route(
    'user/profile',
    'Rudolf\Modules\Users\Profile\Controller::profile'
));
