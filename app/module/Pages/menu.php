<?php

use Rudolf\Component\Helpers\Navigation\MenuItem;

$id = $collection->add(new MenuItem([
    'parent_id' => 0,
    'title' => _('Pages'),
    'caption' => _('Pages'),
    'slug' => 'admin/pages',
    'menu_type' => 'main',
    'item_type' => 'app',
    'position' => 30,
    'ico' => 'fa-file'
]));
$collection->add(new MenuItem([
    'parent_id' => $id,
    'title' => _('Pages list'),
    'caption' => _('Pages list'),
    'slug' => 'admin/pages/list',
    'menu_type' => 'main',
    'item_type' => 'app',
    'position' => 0,
    'ico' => 'fa-list'
]));
$collection->add(new MenuItem([
    'parent_id' => $id,
    'title' => _('Add page'),
    'caption' => _('Add page'),
    'slug' => 'admin/pages/add',
    'menu_type' => 'main',
    'item_type' => 'app',
    'position' => 1,
    'ico' => 'fa-plus'
]));
