<?php

namespace Rudolf\Modules\pages;
use \Rudolf\Abstracts\Model;

class PagesModel extends Model {
	
	public function getPageIdByPath($path, $pages = false) {
		if(false === $pages) {
			$pages = $this->getPagesList();
		}

		for($pid = 0, $i = 0; $i < count($path); ++$i) {
			if($pages[$path[$i]][$pid]['id']) {
				$pid = $pages[$path[$i]][$pid]['id'];
			} else {
				return false;
			}
		}
		return $pid;
	}

	/**
	 * 
	 * @return array
	 */
	public function getPagesList() {
		$stmt = $this->pdo->prepare("SELECT id, parent_id, slug, title, published FROM {$this->prefix}pages");
		$stmt->execute();
		$results = $stmt->fetchAll();
		$stmt->closeCursor();

		if(empty($results)) {
			return false;
		}

		foreach ($results as $key => $value) {
			$array[$value['slug']] = array(
				'id' => $value['id'],
				'parent_id' => $value['parent_id'],
				'slug' => $value['slug'],
				'title' => $value['title'],
				'published' => $value['published']
			);
		}

		return $array;
	}
}
