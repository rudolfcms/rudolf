<?php

namespace Rudolf\Modules\A_front;
use Rudolf\Component\Abstracts\AView,
	Rudolf\Component\Html\Navigation;

abstract class FView extends AView {

	public function setFrontData($menu, $current = 0) {
		$this->frontData = [$menu, $current];
	}

	public function pageNav($type, $classes, $nesting = 0) {
		$object = new Navigation();
		$items = $this->frontData[0]['menu_items'];
		$current = $this->frontData[1];
		
		if(!is_array($current)) {
			$current = array($current);
		}
		
		return $object->createPageNavigation($type, $items, $current, $classes, $nesting);
	}
}
