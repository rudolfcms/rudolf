<?php

use Rudolf\Component\Helpers\Navigation\MenuItem;

$id = $collection->add(new MenuItem([
    'parent_id' => 0,
    'title' => _('Galleries'),
    'caption' => _('Galleries'),
    'slug' => 'admin/galleries',
    'menu_type' => 'main',
    'item_type' => 'app',
    'position' => 50,
    'ico' => 'fa-picture-o',
]));
$collection->add(new MenuItem([
    'parent_id' => $id,
    'title' => _('Galleries list'),
    'caption' => _('Galleries list'),
    'slug' => 'admin/galleries/list',
    'menu_type' => 'main',
    'item_type' => 'app',
    'position' => 0,
    'ico' => 'fa-list',
]));
$collection->add(new MenuItem([
    'parent_id' => $id,
    'title' => _('Add gallery'),
    'caption' => _('Add gallery'),
    'slug' => 'admin/galleries/add',
    'menu_type' => 'main',
    'item_type' => 'app',
    'position' => 1,
    'ico' => 'fa-plus',
]));
