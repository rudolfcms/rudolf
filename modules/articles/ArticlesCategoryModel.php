<?php
/**
 * This file is part of lcms articles module.
 *
 * This is the model of articles module.
 *
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package lcms
 * @version 0.1
 */
 
namespace Modules\articles;

use lcms\Abstracts\Model,
	\PDO;

class ArticlesCategoryModel extends Model {

	/**
	 * Get category info
	 * 
	 * @param string $slug
	 * 
	 * @return array
	 */
	public function getCategoryInfo($slug) {
		try {
			$stmt = $this->pdo->prepare("SELECT * FROM {$this->prefix}categories WHERE slug = :slug and type = :type");
			$stmt->bindValue(':slug', $slug, \PDO::PARAM_INT);
			$stmt->bindValue(':type', 'articles', \PDO::PARAM_STR);
			$stmt->execute();
			$results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		} catch (\PDOException $e) {
			die($e);
		}

		if(empty($results[0])) {
			return false;
		}

		return $results[0];
	}
}
