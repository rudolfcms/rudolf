<?php

use Rudolf\Component\Helpers\Navigation\MenuItem;

$id = $collection->add(new MenuItem([
    'parent_id' => 0,
    'title' => _('Dashboard'),
    'caption' => _('Dashboard'),
    'slug' => 'admin/dashboard',
    'menu_type' => 'main',
    'item_type' => 'app',
    'position' => 10,
    'ico' => 'fa-tachometer'
]));
$collection->add(new MenuItem([
    'parent_id' => $id,
    'title' => _('Overview'),
    'caption' => _('Overview'),
    'slug' => 'admin/dashboard/overview',
    'menu_type' => 'main',
    'item_type' => 'app',
    'position' => 0,
    'ico' => 'fa-home'
]));
