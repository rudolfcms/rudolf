<?php

$id = $this->addItem(
    $menu_type = 'main',
    $title = _('Articles'),
    $slug = 'articles',
    $parent_id = 0,
    $isAdmin = true,
    $caption = _('Articles'),
    $position = 20,
    $font_awesome_ico = 'fa-pencil'
);

$this->addItem('main', _('Articles list'), 'articles/list', $id, true, _('Articles list'), 2, 'fa-list');
$this->addItem('main', _('Add article'), 'articles/add', $id, true, _('Add article'), 3, 'fa-plus');

$catID = $this->addItem('main', _('Categories'), 'articles/categories', $id, true, _('Categories'), 4, 'fa fa-folder');
$this->addItem('main', _('Categories list'), 'articles/categories/list', $catID, true, _('Categories list'), 2, 'fa-list');
$this->addItem('main', _('Add category'), 'articles/categories/add', $catID, true, _('Add category'), 3, 'fa-plus');