<?php

$id = $this->addItem(
    $menu_type = 'main',
    $title = 'Albums',
    $slug = 'albums',
    $parent_id = 0,
    $isAdmin = true,
    $caption = 'albums',
    $position = 40,
    $font_awesome_ico = 'fa-camera'
);

$this->addItem('main', 'List', 'albums/list', $id, true, 'Albums list', 2, 'fa-list');
$this->addItem('main', 'Add', 'albums/add', $id, true, 'Add album', 3, 'fa-plus');

$catID = $this->addItem('main', 'Categories', 'albums/categories', $id, true, 'Category list', 4, 'fa fa-folder');
$this->addItem('main', 'List', 'albums/categories/list', $catID, true, 'Categories list', 2, 'fa-list');
$this->addItem('main', 'Add', 'albums/categories/add', $catID, true, 'Add categories', 3, 'fa-plus');