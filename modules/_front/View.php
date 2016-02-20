<?php

namespace Rudolf\Modules\_front;
use Rudolf\Html\Navigation;

class View extends \Rudolf\Abstracts\View {

	public function setFrontData($menu, $current = 0) {
		$this->frontData = [$menu, $current];
	}

	public function pageNav($type, $class, $nesting = 0) {
		$object = new Navigation();
		$items = $this->frontData[0]['menu_items'];
		$current = $this->frontData[1];
		
		return $object->createPageNavigation($type, $items, $current, $class, $nesting);
	}
}
