<?php
/**
 * This file is part of Rudolf articles module.
 *
 * This is the model of articles module.
 *
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package Rudolf\Modules\Articles\Roll
 * @version 0.1
 */
 
namespace Rudolf\Modules\Articles\Roll;
use Rudolf\Abstracts\AModel,
	Rudolf\Libs\Pagination;

class Model extends AModel {

	/**
	 * @var int Number of all items
	 */
	public $total;

	/**
	 * Returns array with articles list
	 *
	 * @param int $page
	 * @param string|array $where
	 * @param array $paginationConfig
	 *
	 * @return array
	 */
	public function getList(Pagination $pagination, $orderBy = ['id', 'desc']) {
		// if page number is greater than number of all elements
		if($pagination->getPageNumber() > $pagination->getAllPages()) {
			//$page = 1;
			return false;
		}

		$limit = $pagination->getLimit();
		$onPage = $pagination->getOnPage();

		$clausule = $this->createWhereClausule($this->where);
		
		$stmt = $this->pdo->prepare("SELECT
			-- article fields
			a.id, a.category_id, a.title,
			a.content, a.description,
			a.author, a.date, a.added, a.modified, a.modified_by,
			a.views, a.slug, a.album, a.thumb, a.photos, a.published,

			-- user fields
			c.id as user_id, c.first_name, c.surname,
			m.id as modified_user_id, m.first_name as modified_first_name, m.surname as modified_surname,

			-- category fields
			d.title as category_title, d.slug as category_url

			FROM {$this->prefix}articles as a

			-- user join on added_by id
			LEFT JOIN {$this->prefix}users as m ON a.modified_by=m.id

			-- user join on modified id
			LEFT JOIN {$this->prefix}users as c ON a.added_by=c.id

			-- category join on article category_id
			LEFT JOIN {$this->prefix}categories as d ON a.category_id=d.id

			WHERE $clausule ORDER BY $orderBy[0] $orderBy[1] LIMIT $limit, $onPage
		");

		$stmt->execute();
		$results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		$stmt->closeCursor();
		

		if(!empty($results)) {
			return $results;
			
		}
		return false;
	}

	/**
	 * Returns total number of articles items
	 * 
	 * @param array|string $where
	 * 
	 * @return int
	 */
	public function getTotalNumber($where = ['published'=>1]) {
		$this->where = $where;
		return $this->countItems('articles', $where);
	}
}
