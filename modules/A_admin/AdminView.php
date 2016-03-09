<?php

namespace Rudolf\Modules\A_admin;
use Rudolf\Abstracts\AView,
	Rudolf\Html\Navigation,
	Rudolf\Modules\Module;

class AdminView extends AView {

	/**
	 * @var array $userInfo
	 * @access private
	 */
	private static $userInfo;

	/**
	 * @var array $adminData
	 * @access private
	 */
	private static $adminData;

	/**
	 * @var string $active
	 * @access private
	 */
	private static $active;

	public function __construct() {
		$module = new Module('dashboard');
		$this->config = $module->getConfig();

		parent::__construct();
	}

	/**
	 * Create page nav
	 * 
	 * @param string $type
	 * @param int $nesting
	 * @param array $classes
	 * @param array $before
	 * @param array $after
	 * 
	 * @return string
	 */
	public function pageNav($type, $nesting = 0, $classes, $before = false, $after = false) {
		$object = new Navigation();
		$items = self::$adminData['menu_items'];
		$currents = self::$active;

		if(!is_array($currents)) {
			$currents = array($currents);
		}
		
		return $object->createPageNavigation($type, $items, $currents, $classes, $nesting, $before, $after);
	}

	public function adminDir() {
		return DIR . '/' . $this->config['admin_path'];
	}

	public function setActive($active) {
		self::$active = $active;
	}

	/**
	 * 
	 * @return void
	 */
	public static function setAdminData($adminData) {
		self::$adminData = $adminData;
	}

	/**
	 * 
	 * @return void
	 */
	public static function setUserInfo($userInfo) {
		self::$userInfo = $userInfo;
	}

	/**
	 * 
	 * @return string
	 */
	protected function getUserName() {
		return self::$userInfo['first_name'];
	}

	/**
	 * 
	 * @return string
	 */
	protected function getUserFullName() {
		return self::$userInfo['first_name'] . ' ' . self::$userInfo['surname'];
	}

	/**
	 * 
	 * @return string
	 */
	protected function getUserEmail() {
		return self::$userInfo['email'];
	}

	/**
	 * 
	 * @return string
	 */
	protected function getUserNick() {
		return self::$userInfo['nick'];
	}

	/**
	 * 
	 * @return string
	 */
	protected function getUserRegisterDate() {
		return self::$userInfo['dt'];
	}
}
