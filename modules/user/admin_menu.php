<?php

# user
$id = $this->addItem(
	$menu_type = 'top-right',
	$title = 'User',
	$slug = 'user',
	$parent_id = 0,
	$isAdmin = true,
	$caption = 'user',
	$position = 0,
	$font_awesome_ico = 'fa-user'
);

$this->addItem('top-right', 'Logout', 'user/logout', $id, true, 'Logout', 0, 'fa-sign-out');

# users
$id = $this->addItem(
	$menu_type = 'main',
	$title = 'Users',
	$slug = 'users',
	$parent_id = 0,
	$isAdmin = true,
	$caption = 'users',
	$position = 11,
	$font_awesome_ico = 'fa-users'
);

$this->addItem('main', 'list', 'users/list', $id, true, 'list', 0, 'fa-list');