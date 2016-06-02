<?php
# users
$aid = $this->addItem(
    $menu_type = 'main',
    $title = 'Users',
    $slug = 'users',
    $parent_id = 0,
    $isAdmin = false,
    $caption = 'users',
    $position = 11,
    $font_awesome_ico = 'fa-users'
);

$this->addItem('main', 'list', 'users/list', $aid, false, 'list', 0, 'fa-list');

# user
$id = $this->addItem(
    $menu_type = 'top-right',
    $title = 'User',
    $slug = 'user',
    $parent_id = 0,
    $isAdmin = false,
    $caption = 'user',
    $position = 0,
    $font_awesome_ico = 'fa-user'
);

$this->addItem('top-right', 'Logout', 'user/logout', $id, false, 'Logout', 0, 'fa-sign-out');

