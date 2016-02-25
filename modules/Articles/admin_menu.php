<?php

$id = $this->addItem(
	$menu_type = 'main',
	$title = 'Articles',
	$slug = 'articles',
	$parent_id = 0,
	$isAdmin = true,
	$caption = 'articles',
	$position = 10,
	$font_awesome_ico = 'fa-pencil'
);

$this->addItem('main', 'List', 'articles/list', $id, true, 'Articles list', 0, 'fa-list');
$this->addItem('main', 'Add', 'articles/add', $id, true, 'Add article', 0, 'fa-plus');
