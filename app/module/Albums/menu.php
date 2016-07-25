<?php

use Rudolf\Component\Helpers\Navigation\MenuItem;

$id = $collection->add(new MenuItem([
    'parent_id' => 0,
    'title' => _('Albums'),
    'caption' => _('Albums'),
    'slug' => 'admin/albums',
    'menu_type' => 'main',
    'item_type' => 'app',
    'position' => 40,
    'ico' => 'fa-camera'
]));
$collection->add(new MenuItem([
    'parent_id' => $id,
    'title' => _('Albums list'),
    'caption' => _('Albums list'),
    'slug' => 'admin/albums/list',
    'menu_type' => 'main',
    'item_type' => 'app',
    'position' => 0,
    'ico' => 'fa-list'
]));
$collection->add(new MenuItem([
    'parent_id' => $id,
    'title' => _('Add album'),
    'caption' => _('Add album'),
    'slug' => 'admin/albums/add',
    'menu_type' => 'main',
    'item_type' => 'app',
    'position' => 1,
    'ico' => 'fa-plus'
]));

$cid = $collection->add(new MenuItem([
    'parent_id' => $id,
    'title' => _('Categories'),
    'caption' => _('Categories'),
    'slug' => 'admin/albums/categories',
    'menu_type' => 'main',
    'item_type' => 'app',
    'position' => 2,
    'ico' => 'fa-folder'
]));
$collection->add(new MenuItem([
    'parent_id' => $cid,
    'title' => _('Categories list'),
    'caption' => _('Categories list'),
    'slug' => 'admin/albums/categories/list',
    'menu_type' => 'main',
    'item_type' => 'app',
    'position' => 0,
    'ico' => 'fa-list'
]));
$collection->add(new MenuItem([
    'parent_id' => $cid,
    'title' => _('Add category'),
    'caption' => _('Add category'),
    'slug' => 'admin/albums/categories/add',
    'menu_type' => 'main',
    'item_type' => 'app',
    'position' => 1,
    'ico' => 'fa-plus'
]));
