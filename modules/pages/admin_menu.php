<?php

$id = $this->addItem(
	$menu_type = 'main',
	$title = 'Pages',
	$slug = 'pages',
	$parent_id = 0,
	$isAdmin = true,
	$caption = 'pages',
	$position = 10,
	$font_awesome_ico = 'fa-file'
);

$this->addItem('main', 'List', 'pages/list', $id, true, 'Pages list', 0, 'fa-list');
$this->addItem('main', 'Add', 'pages/add', $id, true, 'Add page', 0, 'fa-plus');
