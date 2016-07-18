<?php

$id = $this->addItem(
    $menu_type = 'main',
    $title = 'Dashboard',
    $slug = '',
    $parent_id = 0,
    $isAdmin = true,
    $caption = 'Dashboard',
    $position = 10,
    $font_awesome_ico = 'fa-tachometer'
);

$this->addItem('main', 'Overview', 'overview', $id, true, 'overview', 0, 'fa-home');