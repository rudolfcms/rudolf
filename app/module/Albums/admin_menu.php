<?php

$id = $this->addItem(
    $menu_type = 'main',
    $title = _('Albums'),
    $slug = 'albums',
    $parent_id = 0,
    $isAdmin = true,
    $caption = _('Albums'),
    $position = 40,
    $font_awesome_ico = 'fa-camera'
);

$this->addItem('main', _('Albums list'), 'albums/list', $id, true, _('Albums list'), 2, 'fa-list');
$this->addItem('main', _('Add album'), 'albums/add', $id, true, _('Add album'), 3, 'fa-plus');

$catID = $this->addItem('main', _('Categories'), 'albums/categories', $id, true, _('Categories'), 4, 'fa fa-folder');
$this->addItem('main', _('Categories list'), 'albums/categories/list', $catID, true, _('Categories list'), 2, 'fa-list');
$this->addItem('main', _('Add category'), 'albums/categories/add', $catID, true, _('Add category'), 3, 'fa-plus');
