<?php

use Rudolf\Component\Helpers\Navigation\MenuItem;

/** @var \Rudolf\Component\Helpers\Navigation\MenuItemCollection $collection */
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

$menuId = $collection->add(new MenuItem([
    'parent_id' => $id,
    'title' => _('Menu'),
    'caption' => _('Menu'),
    'slug' => 'admin/appearance/menu',
    'menu_type' => 'main',
    'item_type' => 'app',
    'position' => 2,
    'ico' => 'fa-bars',
]));

$collection->add(new MenuItem([
    'parent_id' => $menuId,
    'title' => _('Add item'),
    'caption' => _('Add item'),
    'slug' => 'admin/appearance/menu/add-item',
    'menu_type' => 'main',
    'item_type' => 'app',
    'position' => 0,
    'ico' => 'fa-plus',
]));

$collection->add(new MenuItem([
    'parent_id' => $menuId,
    'title' => _('Add menu'),
    'caption' => _('Add menu'),
    'slug' => 'admin/appearance/menu/add-type',
    'menu_type' => 'main',
    'item_type' => 'app',
    'position' => 1,
    'ico' => 'fa-plus',
]));
