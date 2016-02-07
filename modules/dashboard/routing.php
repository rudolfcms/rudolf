<?php

$module = new \Rudolf\Modules\Module('dashboard');
$config = $module->getConfig();

$collection->add('dashboard', new Rudolf\Routing\Route(
	$config['admin_path'] . '?',
	'Rudolf\Modules\dashboard\DashboardController',
	[],
	[],
	999
));
