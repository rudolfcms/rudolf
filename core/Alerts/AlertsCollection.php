<?php

namespace Rudolf\Alerts;

class AlertsCollection {

	/**
	 * @var array
	 */
	private static $collection;

	/**
	 * Add alert to collection
	 * 
	 * @param Alert $alert Alert object
	 * 
	 * @return void
	 */
	public static function add(\Rudolf\Alerts\Alert $alert) {
		self::$collection[] = $alert;
	}

	/**
	 * Get alerts by type
	 * 
	 * @param string $type Alert type
	 * 
	 * @return Alert array
	 */
	public static function getByType($type) {
		$collection = self::$collection;

		foreach (self::$collection as $key => $value) {
			if($type === $value->getType()) {
				$newCollection[] = $value;
			}
		}

		return $newCollection;
	}

	/**
	 * Get all alerts
	 * 
	 * @return Alert array
	 */
	public static function getAll() {
		return self::$collection;
	}
}
