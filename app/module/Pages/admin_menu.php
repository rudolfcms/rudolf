<?php

$id = $this->addItem(
    $menu_type = 'main',
    $title = _('Pages'),
    $slug = 'pages',
    $parent_id = 0,
    $isAdmin = true,
    $caption = _('Pages'),
    $position = 30,
    $font_awesome_ico = 'fa-file'
);

$this->addItem('main', _('Pages list'), 'pages/list', $id, true, _('Pages list'), 0, 'fa-list');
$this->addItem('main', _('Add page'), 'pages/add', $id, true, _('Add page'), 0, 'fa-plus');
