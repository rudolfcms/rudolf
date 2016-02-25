<?php

namespace Rudolf\Modules\A_admin;
use Rudolf\Modules\Module;

class ModulesMenu {

	private $items;

	public function getMenuItems() {
		$module = new Module('dashboard');
		$this->dashboardConfig = $module->getConfig();

		$catalog = MODULES_ROOT;

		foreach(glob($catalog . '/*', GLOB_ONLYDIR) as $dir) {
			$dir = str_replace($catalog . '/', '', $dir);
			$array[] = $dir;
		}

		for($i=0; $i < count($array); $i++) { 
			$file = MODULES_ROOT . '/' . $array[$i] . '/admin_menu.php';
			
			if(file_exists($file)) {
				include $file;
			}
		}

		return $this->items;
	}

	private function addFAIco($items) {
		foreach ($items as $key => $value) {
			if(!empty($items[$key]['fa_ico'])) {
				$fa_ico = '<i class="fa '.$items[$key]['fa_ico'].'"></i>';
			} else $fa_ico = null;
			$items[$key]['title'] = trim($fa_ico . ' ' .$items[$key]['title']);
		}
		return $items;
	}

	/**
	 * Add item to admin menu
	 * 
	 * @param string $type Menu type identyfier
	 * @param string $title Item title
	 * @param string $caption Item caption
	 * @param int $pid Parent ID
	 * @param int $ps Position
	 * @param string $f Font awesome icon id
	 * 
	 * @return int $id
	 */
	private function addItem($type, $title, $slug, $pid=0, $admin=true, $cp='', $ps=10, $f='') {
		$id = count($this->items) + 1;

		$this->items[] = [
			'id' => $id,
			'menu_type' => $type,
												// replace addFAIco
			'title' => (!empty($f)) ? '<i class="fa '.$f.'"></i> ' . $title : $title, 
			'slug' => ($admin) ? $this->dashboardConfig['admin_path'] . '/' . $slug : $slug,
			'parent_id' => $pid,
			'caption' => $cp,
			'position' => $ps
		];

		return $id;
	}
}
