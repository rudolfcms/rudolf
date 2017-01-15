<?php

use Rudolf\Component\Routing\Route;

$collection->add('admin', new Route(
    'admin([\/])?',
    'Rudolf\Modules\Dashboard\Controller::redirectTo',
    [],
    ['target' => DIR.'/admin/dashboard/overview']
));
$collection->add('dashboard', new Route(
    'admin/dashboard([\/])?',
    'Rudolf\Modules\Dashboard\Controller::redirectTo',
    [],
    ['target' => DIR.'/admin/dashboard/overview']
));
$collection->add('dashboard/overview', new Route(
    'admin/dashboard/overview?',
    'Rudolf\Modules\Dashboard\Controller'
));
