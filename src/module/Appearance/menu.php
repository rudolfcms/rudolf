<?php

use Rudolf\Component\Helpers\Navigation\MenuItem;

$id = $collection->add(new MenuItem([
    'parent_id' => 0,
    'title' => _('Appearance'),
    'caption' => _('Appearance'),
    'slug' => 'admin/appearance',
    'menu_type' => 'main',
    'item_type' => 'app',
    'position' => 75,
    'ico' => 'fa-paint-brush',
]));
$collection->add(new MenuItem([
    'parent_id' => $id,
    'title' => _('Themes list'),
    'caption' => _('Themes list'),
    'slug' => 'admin/appearance/list',
    'menu_type' => 'main',
    'item_type' => 'app',
    'position' => 0,
    'ico' => 'fa-list',
]));
$collection->add(new MenuItem([
    'parent_id' => $id,
    'title' => _('Editor'),
    'caption' => _('Editor'),
    'slug' => 'admin/appearance/editor',
    'menu_type' => 'main',
    'item_type' => 'app',
    'position' => 1,
    'ico' => 'fa-wrench',
]));
