<?php

$id = $this->addItem(
    $menu_type = 'main',
    $title = 'Koxy',
    $slug = 'koxy',
    $parent_id = 0,
    $isAdmin = true,
    $caption = 'koxy',
    $position = 60,
    $font_awesome_ico = 'fa-file-word-o'
);

$this->addItem('main', 'List', 'koxy/list', $id, true, 'Koxy list', 0, 'fa-list');
$this->addItem('main', 'Add', 'koxy/add', $id, true, 'Add kox', 0, 'fa-plus');
