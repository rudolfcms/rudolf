<?php
/**
 * This file is part of Rudolf articles module.
 *
 * This is the model of articles module.
 *
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package Rudolf\Modules\articles
 * @version 0.1
 */
 
namespace Rudolf\Modules\articles;

use Rudolf\Abstracts\Model,
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
			echo '<code>Mysql error: '.$e->getMessage().'<br/><br/>In: '.$e->getFile().' on '.$e->getLine().'</code>';
			exit;
		}

		if(empty($results[0])) {
			return false;
		}

		return $results[0];
	}
}
