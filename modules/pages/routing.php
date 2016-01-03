<?php
/**
 * This file is part of pages Rudolf module.
 * 
 * Pages route
 * 
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package Rudolf\Modules\pages
 * @version 0.1
 */

use Rudolf\Routing;

$collection->add('pages', new Routing\Route(
	'<page>',
	'Rudolf\Modules\pages\PagesController::page',
	array(
		'page' => "[a-z0-9-\/]*?(?<!\/)$" // without end slash
		//'page' => "[a-z0-9-\/]*?$" // with end slash
	)
));
