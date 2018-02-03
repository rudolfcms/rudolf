<?php

use Rudolf\Component\Helpers\Navigation\MenuItem;

$id = $collection->add(new MenuItem([
    'parent_id' => 0,
    'title' => _('Tools'),
    'caption' => _('Tools'),
    'slug' => 'admin/tools',
    'menu_type' => 'main',
    'item_type' => 'app',
    'position' => 90,
    'ico' => 'fa-wrench',
]));

$collection->add(new MenuItem([
    'parent_id' => $id,
    'title' => _('Database dump'),
    'caption' => _('Database dump'),
    'slug' => 'admin/tools/db-dump',
    'menu_type' => 'main',
    'item_type' => 'app',
    'position' => 0,
    'ico' => 'fa-database',
]));


$collection->add(new MenuItem([
    'parent_id' => $id,
    'title' => _('Database import'),
    'caption' => _('Database import'),
    'slug' => 'admin/tools/db-import',
    'menu_type' => 'main',
    'item_type' => 'app',
    'position' => 1,
    'ico' => 'fa-level-up',
]));
