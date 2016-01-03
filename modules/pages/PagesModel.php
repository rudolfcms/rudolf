<?php
/**
 * This file is part of pages Rudolf module.
 * 
 * Pages model
 * 
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package Rudolf\Modules\pages
 * @version 0.1
 */

namespace Rudolf\Modules\pages;
use Rudolf\Abstracts\Model;

class PagesModel extends Model {
	
	/**
	 * Returns page id by path
	 * 
	 * @param array $path
	 * @param array $pages
	 * 
	 * @return int|bool
	 */
	public function getPageIdByPath($path, $pages = false) {
		if(false === $pages) {
			$pages = $this->getPagesList();
		}

		for($pid = 0, $i = 0; $i < count($path); ++$i) {
			if(isset($pages[$path[$i]]['parent_id']) && $pid == $pages[$path[$i]]['parent_id']) {
				$pid = $pages[$path[$i]]['id'];
			} else {
				return false;
			}
		}
		return $pid;
	}

	/**
	 * Returns pages list
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

	/**
	 * Returns page data
	 * 
	 * @param int $id
	 * 
	 * @return array
	 */
	public function getPageById($id) {
		$stmt = $this->pdo->prepare("SELECT * FROM {$this->prefix}pages WHERE id = :id");
		$stmt->bindParam(':id', $id, \PDO::PARAM_INT);
		$stmt->execute();
		$results = $stmt->fetchAll();
		$stmt->closeCursor();
		
		if(empty($results)) {
			return false;
		}
		return $results[0];
	}
}
