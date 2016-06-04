<?php

$id = $this->addItem(
    $menu_type = 'main',
    $title = 'Albums',
    $slug = 'albums',
    $parent_id = 0,
    $isAdmin = true,
    $caption = 'albums',
    $position = 10,
    $font_awesome_ico = 'fa-camera'
);

$this->addItem('main', 'List', 'albums/list', $id, true, 'Albums list', 2, 'fa-list');
$this->addItem('main', 'Add', 'albums/add', $id, true, 'Add album', 3, 'fa-plus');
