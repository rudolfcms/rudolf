<?php
/**
 * This file is part of Rudolf articles module.
 *
 * This is the model of articles module.
 *
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package Rudolf\Modules\Articles\One
 * @version 0.1
 */
 
namespace Rudolf\Modules\Articles\One;
use Rudolf\Abstracts\AModel;

class Model extends AModel {

	public function getOneByDate($year, $month, $slug) {
		$stmt = $this->pdo->prepare("SELECT 
			-- article fields
			a.id, a.category_id, a.title, a.keywords, a.description, a.content, a.author, 
			a.added_by, a.date, a.added, a.modified, a.modified_by, a.views, 
			a.slug, a.album, a.thumb, a.photos, a.published, 

			-- user fields
			u.first_name, u.surname, 

			m.first_name as 'modified_first_name', m.surname as 'modified_surname', 

			-- category fields
			c.title as category_title, c.slug as category_url 

			FROM {$this->prefix}articles as a 

			-- user join on added_by id
			LEFT JOIN {$this->prefix}users as u ON a.added_by=u.id 

			-- user join on modified_by id
			LEFT JOIN {$this->prefix}users as m ON a.modified_by=m.id

			-- category join on article category_id
			LEFT JOIN {$this->prefix}categories as c ON a.category_id=c.id 

			WHERE YEAR(`date`) = :year AND MONTH(`date`) = :month AND a.slug = :slug
		");
		$stmt->bindValue(':year', $year, \PDO::PARAM_INT);
		$stmt->bindValue(':month', $month, \PDO::PARAM_INT);
		$stmt->bindValue(':slug', $slug, \PDO::PARAM_STR);
		$stmt->execute();
		$this->results = $stmt->fetch(\PDO::FETCH_ASSOC);
		
		if(empty($this->results)) {
			return false;
		}

		return $this->results;
	}

	public function getOneById($id) {
		$stmt = $this->pdo->prepare("SELECT 
			-- article fields
			a.id, a.category_id, a.title, a.keywords, a.description, a.content, a.author, 
			a.added_by, a.date, a.added, a.modified, a.modified_by, a.views, 
			a.slug, a.album, a.thumb, a.photos, a.published, 

			-- user fields
			u.first_name, u.surname, 

			m.first_name as 'modified_first_name', m.surname as 'modified_surname', 

			-- category fields
			c.title as category_title, c.slug as category_url 

			FROM {$this->prefix}articles as a 

			-- user join on added_by id
			LEFT JOIN {$this->prefix}users as u ON a.added_by=u.id 

			-- user join on modified_by id
			LEFT JOIN {$this->prefix}users as m ON a.modified_by=m.id

			-- category join on article category_id
			LEFT JOIN {$this->prefix}categories as c ON a.category_id=c.id 

			WHERE a.id = :id
		");
		$stmt->bindValue(':id', $id, \PDO::PARAM_INT);
		$stmt->execute();
		$this->results = $stmt->fetch(\PDO::FETCH_ASSOC);
		
		if(empty($this->results)) {
			return false;
		}

		return $this->results;
	}

	/**
	 * Increment article views 
	 */
	public function addView() {
		$info = $this->results;

		$stmt = $this->pdo->prepare("UPDATE {$this->prefix}articles SET views = :v WHERE id = :id");
		$stmt->bindValue(':v', ++$info['views'], \PDO::PARAM_INT);
		$stmt->bindValue(':id', $info['id'], \PDO::PARAM_INT);
		$stmt->execute();
	}
}