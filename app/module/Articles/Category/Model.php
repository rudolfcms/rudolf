<?php
/**
 * This file is part of Rudolf articles module.
 *
 * This is the model of articles module.
 *
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package Rudolf\Modules\Articles\Category
 * @version 0.1
 */
 
namespace Rudolf\Modules\Articles\Category;
use Rudolf\Component\Abstracts\AModel;

class Model extends AModel {

	/**
	 * Get category info
	 * 
	 * @param string $slug
	 * 
	 * @return array
	 */
	public function getCategoryInfo($slug) {
		$stmt = $this->pdo->prepare("SELECT * FROM {$this->prefix}categories WHERE slug = :slug and type = :type");
		$stmt->bindValue(':slug', $slug, \PDO::PARAM_INT);
		$stmt->bindValue(':type', 'articles', \PDO::PARAM_STR);
		$stmt->execute();
		$results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		if(empty($results[0])) {
			return false;
		}

		return $results[0];
	}
}
