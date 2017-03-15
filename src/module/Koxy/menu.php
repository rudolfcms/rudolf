<?php

use Rudolf\Component\Helpers\Navigation\MenuItem;

$id = $collection->add(new MenuItem([
    'parent_id' => 0,
    'title' => _('Koxy'),
    'caption' => _('Koxy'),
    'slug' => 'admin/koxy',
    'menu_type' => 'main',
    'item_type' => 'app',
    'position' => 60,
    'ico' => 'fa-file-word-o',
]));
$collection->add(new MenuItem([
    'parent_id' => $id,
    'title' => _('Koxy list'),
    'caption' => _('Koxy list'),
    'slug' => 'admin/koxy/list',
    'menu_type' => 'main',
    'item_type' => 'app',
    'position' => 0,
    'ico' => 'fa-list',
]));
$collection->add(new MenuItem([
    'parent_id' => $id,
    'title' => _('Add kox'),
    'caption' => _('Add kox'),
    'slug' => 'admin/koxy/add',
    'menu_type' => 'main',
    'item_type' => 'app',
    'position' => 1,
    'ico' => 'fa-plus',
]));
