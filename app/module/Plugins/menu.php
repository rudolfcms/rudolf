<?php

use Rudolf\Component\Helpers\Navigation\MenuItem;

$id = $collection->add(new MenuItem([
    'parent_id' => 0,
    'title' => _('Plugins'),
    'caption' => _('Plugins'),
    'slug' => 'admin/plugins',
    'menu_type' => 'main',
    'item_type' => 'app',
    'position' => 80,
    'ico' => 'fa-plug',
]));
$collection->add(new MenuItem([
    'parent_id' => $id,
    'title' => _('Plugins list'),
    'caption' => _('Plugins list'),
    'slug' => 'admin/plugins/list',
    'menu_type' => 'main',
    'item_type' => 'app',
    'position' => 0,
    'ico' => 'fa-list',
]));
