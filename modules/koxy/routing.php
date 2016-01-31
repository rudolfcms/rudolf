<?php
/**
 * This file is part of koxy Rudolf module.
 * 
 * Pages route
 * 
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package Rudolf\Modules\koxy
 * @version 0.1
 */

use Rudolf\Routing;

$collection->add('koxy', new Routing\Route(
	'(page/<page>)?',
	'Rudolf\Modules\koxy\KoxyController',
	array(
		'page' => "[1-9][0-9]*$"
	),
	array(
		'page' => 0
	),
	$priority = 1000
));
