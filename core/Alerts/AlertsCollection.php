<?php

namespace Rudolf\Alerts;

class AlertsCollection {

	/**
	 * @var array
	 */
	private $collection;

	/**
	 * Add alert to collection
	 * 
	 * @param Alert $alert Alert object
	 * 
	 * @return void
	 */
	public function add(Rudolf\Alerts\Alert $alert) {
		$this->collection[] = $alert;
	}

	/**
	 * Get alerts by type
	 * 
	 * @param string $type Alert type
	 * 
	 * @return Alert array
	 */
	public function getByType($type) {
		$collection = $this->collection;

		foreach ($this->collection as $key => $value) {
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
	public function getAll() {
		return $this->collection;
	}
}
