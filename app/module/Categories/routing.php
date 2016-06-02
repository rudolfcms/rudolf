<?php
use Rudolf\Component\Routing;

$collection->add('categories/admin/roll', new Routing\Route(
    $config['admin_path'] . '/categories/list(/page/<page>)?',
    'Rudolf\Modules\Categories\Roll\Admin\Controller::getList',
    ['page' => "[1-9][0-9]*$"],
    ['page' => 0]
));