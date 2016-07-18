<?php

$id = $this->addItem(
    $menu_type = 'main',
    $title = _('Dashboard'),
    $slug = '',
    $parent_id = 0,
    $isAdmin = true,
    $caption = _('Dashboard'),
    $position = 10,
    $font_awesome_ico = 'fa-tachometer'
);

$this->addItem('main', _('Overview'), 'overview', $id, true, _('Overview'), 0, 'fa-home');
