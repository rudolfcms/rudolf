<?php

use Rudolf\Component\Helpers\Navigation\MenuItem;

$id = $collection->add(new MenuItem([
    'parent_id' => 0,
    'title' => _('Modules'),
    'caption' => _('Modules'),
    'slug' => 'admin/modules',
    'menu_type' => 'main',
    'item_type' => 'app',
    'position' => 70,
    'ico' => 'fa-cubes',
]));
$collection->add(new MenuItem([
    'parent_id' => $id,
    'title' => _('Modules list'),
    'caption' => _('Modules list'),
    'slug' => 'admin/modules/list',
    'menu_type' => 'main',
    'item_type' => 'app',
    'position' => 0,
    'ico' => 'fa-list',
]));
