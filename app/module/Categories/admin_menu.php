<?php

$id = $this->addItem(
    $menu_type = 'main',
    $title = 'Categories',
    $slug = 'categories',
    $parent_id = 0,
    $isAdmin = true,
    $caption = 'categories',
    $position = 7,
    $font_awesome_ico = 'fa fa-folder'
);

$this->addItem('main', 'List', 'categories/list', $id, true, 'Categories list', 2, 'fa-list');
$this->addItem('main', 'Add', 'categories/add', $id, true, 'Add article', 3, 'fa-plus');
