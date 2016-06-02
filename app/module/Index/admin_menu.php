<?php

$id = $this->addItem(
    $menu_type = 'main',
    $title = 'Home page',
    $slug = 'index',
    $parent_id = 0,
    $isAdmin = true,
    $caption = 'home page',
    $position = 10,
    $font_awesome_ico = 'fa-home'
);

$this->addItem('main', 'Config', 'index/config', $id, true, 'Home page config', 0, 'fa-wrench');
