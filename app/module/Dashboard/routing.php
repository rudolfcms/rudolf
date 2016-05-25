<?php

$module = new \Rudolf\Component\Modules\Module('dashboard');
$config = $module->getConfig();

$collection->add('dashboard', new Rudolf\Component\Routing\Route(
	$config['admin_path'] . '?',
	'Rudolf\Modules\Dashboard\Controller'
));
$collection->add('dashboard/overview', new Rudolf\Component\Routing\Route(
	$config['admin_path'] . '/overview?',
	'Rudolf\Modules\Dashboard\Controller'
));
