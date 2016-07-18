<?php

$id = $this->addItem(
    $menu_type = 'main',
    $title = 'Galleries',
    $slug = 'galleries',
    $parent_id = 0,
    $isAdmin = true,
    $caption = 'galleries',
    $position = 50,
    $font_awesome_ico = 'fa-picture-o'
);

$this->addItem('main', 'List', 'galleries/list', $id, true, 'Galleries list', 2, 'fa-list');
$this->addItem('main', 'Add', 'galleries/add', $id, true, 'Add gallery', 3, 'fa-plus');
