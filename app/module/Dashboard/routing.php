<?php
use Rudolf\Component\Routing;
use Rudolf\Component\Modules\Module;

$module = new Module('dashboard');
$config = $module->getConfig();

$collection->add('dashboard', new Routing\Route(
    $config['admin_path'] . '?',
    'Rudolf\Modules\Dashboard\Controller'
));
$collection->add('dashboard/overview', new Routing\Route(
    $config['admin_path'] . '/overview?',
    'Rudolf\Modules\Dashboard\Controller'
));
