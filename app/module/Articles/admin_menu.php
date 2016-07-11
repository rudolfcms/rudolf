<?php

$id = $this->addItem(
    $menu_type = 'main',
    $title = 'Articles',
    $slug = 'articles',
    $parent_id = 0,
    $isAdmin = true,
    $caption = 'articles',
    $position = 5,
    $font_awesome_ico = 'fa-pencil'
);

$this->addItem('main', 'List', 'articles/list', $id, true, 'Articles list', 2, 'fa-list');
$this->addItem('main', 'Add', 'articles/add', $id, true, 'Add article', 3, 'fa-plus');

$catID = $this->addItem('main', 'Categories', 'articles/categories', $id, true, 'Category list', 4, 'fa fa-folder');
$this->addItem('main', 'List', 'articles/categories/list', $catID, true, 'Categories list', 2, 'fa-list');
$this->addItem('main', 'Add', 'articles/categories/add', $catID, true, 'Add categories', 3, 'fa-plus');