<?php

namespace Rudolf\Modules\_admin;
use Rudolf\Abstracts\View,
	Rudolf\Html\Navigation;

class AdminView extends View {

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

	public function pageNav($type, $class, $nesting = 0) {
		$object = new Navigation();
		$items = self::$adminData['menu_items'];
		//$current = $this->frontData[1];
		
		return $object->createPageNavigation($type, $items, $current = '', $class, $nesting);
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
