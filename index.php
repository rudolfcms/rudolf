<?php
/**
 * This file is part of lcms.
 * 
 * This is the main web entry point for lcms.
 * 
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package lcms
 * @version 0.1
 */

/**
 * Constant that is checked in included files to prevent direct access.
 */
define('LCMS', true);

require __DIR__ . '/core/init.php';
