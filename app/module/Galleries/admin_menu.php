<?php

$id = $this->addItem(
    $menu_type = 'main',
    $title = _('Galleries'),
    $slug = 'galleries',
    $parent_id = 0,
    $isAdmin = true,
    $caption = _('Galleries'),
    $position = 50,
    $font_awesome_ico = 'fa-picture-o'
);

$this->addItem('main', _('Galleries list'), 'galleries/list', $id, true, _('Galleries list'), 2, 'fa-list');
$this->addItem('main', _('Add gallery'), 'galleries/add', $id, true, _('Add gallery'), 3, 'fa-plus');
