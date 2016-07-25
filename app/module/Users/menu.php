<?php

use Rudolf\Component\Helpers\Navigation\MenuItem;

$id = $collection->add(new MenuItem([
    'parent_id' => 0,
    'title' => _('Users'),
    'caption' => _('Users'),
    'slug' => 'admin/users',
    'menu_type' => 'main',
    'item_type' => 'app',
    'position' => 80,
    'ico' => 'fa-users'
]));
$collection->add(new MenuItem([
    'parent_id' => $id,
    'title' => _('Users list'),
    'caption' => _('Users list'),
    'slug' => 'admin/users/list',
    'menu_type' => 'main',
    'item_type' => 'app',
    'position' => 0,
    'ico' => 'fa-list'
]));
$collection->add(new MenuItem([
    'parent_id' => $id,
    'title' => _('Add user'),
    'caption' => _('Add user'),
    'slug' => 'admin/users/add',
    'menu_type' => 'main',
    'item_type' => 'app',
    'position' => 1,
    'ico' => 'fa-plus'
]));


// $uid = $collection->add(new MenuItem([
//     'parent_id' => 0,
//     'title' => _('User'),
//     'caption' => _('User'),
//     'slug' => 'user',
//     'menu_type' => 'top-right',
//     'item_type' => 'app',
//     'position' => 10,
//     'ico' => 'fa-user'
// ]));
// $collection->add(new MenuItem([
//     'parent_id' => $uid,
//     'title' => _('Logout'),
//     'caption' => _('Logout'),
//     'slug' => 'user/logout',
//     'menu_type' => 'top-right',
//     'item_type' => 'app',
//     'position' => 0,
//     'ico' => 'fa-sign-out'
// ]));
