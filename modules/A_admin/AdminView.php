<?php

namespace Rudolf\Modules\A_admin;
use Rudolf\Abstracts\AView,
	Rudolf\Html\Navigation;

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

	public function pageNav($type, $class, $nesting = 0) {
		$object = new Navigation();
		$items = self::$adminData['menu_items'];
		$current = self::$active;

		if(!is_array($current)) {
			$current = array($current);
		}
		
		return $object->createPageNavigation($type, $items, $current, $class, $nesting);
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
