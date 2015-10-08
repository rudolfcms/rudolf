<?php defined('LCMS') or die();
/**
 * This file is part of lcms.
 * 
 * Modules Manager.
 * 
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package lcms
 * @version 0.1
 */

class ModulesManager {

	/**
	 * holds path to modules directory
	 * 
	 * @access private
	 * 
	 * @var string
	 */
	private static $path;

	/**
	 * holds modules list
	 * 
	 * @access private
	 * 
	 * @var array
	 */
	private static $modules;

	/**
	 * Run modules manager service.
	 * 
	 * @param string $path from-root path to modules directory
	 * 
	 * @return void
	 */
	public static function run($path = 'modules') {
		self::$path = LROOT . '/' . $path;

		self::$modules = include self::$path . '/index.php';
	}

	/**
	 * Acticate non-active modules.
	 * 
	 * @param string $name module name
	 * 
	 * @return void
	 */
	public static function activate($name) {
		self::$modules[$name] = true;

		self::regenerate_list();
	}

	/**
	 * Deactivate active modules.
	 * 
	 * @param string $name module name
	 * 
	 * @return void
	 */
	public static function deactivate($name) {
		self::$modules[$name] = false;

		self::regenerate_list();
	}

	/**
	 * Add new module to list.
	 * 
	 * @param string $name module name
	 * 
	 * @return void
	 */
	public static function add($name) {
		self::$modules[$name] = false;

		self::regenerate_list();
	}

	/**
	 * Delete module from list.
	 * 
	 * @param string $name module name
	 * 
	 * @return void
	 */
	public static function delete($name) {
		unset(self::$modules[$name]);

		self::regenerate_list();
	}

	/**
	 * Generate modules list and save to index.php file in modules directory.
	 * 
	 * @return void 
	 */
	private static function regenerate_list() {
		ksort(self::$modules);

		$var_str = var_export(self::$modules, true);
		$var = "<?php defined('LCMS') or die();\n/**\n * This file is part of lcms.\n * \n * List of instaled modules. DO NOT EDIT, GENERATED AUTOMATICALLY\n * \n * @author Mikołaj Pich <m.pich@outlook.com>\n * @package lcms\n * @version 0.1\n */\n\nreturn $var_str;\n";
		
		file_put_contents(self::$path . '/index.php', $var);
	}
}
