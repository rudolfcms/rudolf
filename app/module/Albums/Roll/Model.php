<?php
/**
 * This file is part of Rudolf albums module.
 *
 * This is the model of albums module.
 *
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package Rudolf\Modules\Albums\Roll
 * @version 0.1
 */
 
namespace Rudolf\Modules\Albums\Roll;
use Rudolf\Modules\Albums,
	Rudolf\Component\Libs\Pagination;

class Model extends Albums\Model {

	/**
	 * @var int Number of all items
	 */
	public $total;

	/**
	 * Returns array with albums list
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
		
		$stmt = $this->pdo->prepare($this->queryPart('full') .
			"WHERE $clausule ORDER BY $orderBy[0] $orderBy[1] LIMIT $limit, $onPage");

		$stmt->execute();
		$results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		$stmt->closeCursor();
		

		if(!empty($results)) {
			return $results;
		}
		return false;
	}

	/**
	 * Returns total number of albums items
	 * 
	 * @param array|string $where
	 * 
	 * @return int
	 */
	public function getTotalNumber($where = ['published'=>1]) {
		$this->where = $where;
		return $this->countItems('albums', $where);
	}
}