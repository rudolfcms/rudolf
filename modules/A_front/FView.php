<?php

namespace Rudolf\Modules\A_front;
use Rudolf\Abstracts\AView,
	Rudolf\Html\Navigation;

abstract class FView extends AView {

	public function setFrontData($menu, $current = 0) {
		$this->frontData = [$menu, $current];
	}

	public function pageNav($type, $class, $nesting = 0) {
		$object = new Navigation();
		$items = $this->frontData[0]['menu_items'];
		$current = $this->frontData[1];
		
		if(!is_array($current)) {
			$current = array($current);
		}
		
		return $object->createPageNavigation($type, $items, $current, $class, $nesting);
	}
}
