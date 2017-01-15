<?php

use Rudolf\Component\Helpers\Navigation\MenuItem;

$id = $collection->add(new MenuItem([
    'parent_id' => 0,
    'title' => _('Articles'),
    'caption' => _('Articles'),
    'slug' => 'admin/articles',
    'menu_type' => 'main',
    'item_type' => 'app',
    'position' => 20,
    'ico' => 'fa-pencil',
]));
$collection->add(new MenuItem([
    'parent_id' => $id,
    'title' => _('Articles list'),
    'caption' => _('Articles list'),
    'slug' => 'admin/articles/list',
    'menu_type' => 'main',
    'item_type' => 'app',
    'position' => 0,
    'ico' => 'fa-list',
]));
$collection->add(new MenuItem([
    'parent_id' => $id,
    'title' => _('Add article'),
    'caption' => _('Add article'),
    'slug' => 'admin/articles/add',
    'menu_type' => 'main',
    'item_type' => 'app',
    'position' => 1,
    'ico' => 'fa-plus',
]));

$cid = $collection->add(new MenuItem([
    'parent_id' => $id,
    'title' => _('Categories'),
    'caption' => _('Categories'),
    'slug' => 'admin/articles/categories',
    'menu_type' => 'main',
    'item_type' => 'app',
    'position' => 2,
    'ico' => 'fa-folder',
]));
$collection->add(new MenuItem([
    'parent_id' => $cid,
    'title' => _('Categories list'),
    'caption' => _('Categories list'),
    'slug' => 'admin/articles/categories/list',
    'menu_type' => 'main',
    'item_type' => 'app',
    'position' => 0,
    'ico' => 'fa-list',
]));
$collection->add(new MenuItem([
    'parent_id' => $cid,
    'title' => _('Add category'),
    'caption' => _('Add category'),
    'slug' => 'admin/articles/categories/add',
    'menu_type' => 'main',
    'item_type' => 'app',
    'position' => 1,
    'ico' => 'fa-plus',
]));
