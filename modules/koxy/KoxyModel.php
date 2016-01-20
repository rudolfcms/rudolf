<?php

namespace Rudolf\Modules\Koxy;
use Rudolf\Abstracts\Model,
	Rudolf\Libs\Pagination;

class KoxyModel extends Model {
	public function getList(Pagination $pagination, $orderBy = ['id', 'DESC']) {
		// if page number is greater than number of all elements
		if($pagination->getPageNumber() > $pagination->getAllPages()) {
			//$page = 1;
			return false;
		}

		$limit = $pagination->getLimit();
		$onPage = $pagination->getOnPage();

		$catalog = UPLOADS_ROOT . '/moments/';

		if (($array = glob($catalog  . '*.*')) == false) {
			return false;
		}

		foreach ($array as $key => $value) {
			$a[] = str_replace(ROOT, '', $value);
		}

		if($orderBy[1] === 'DESC') {
			rsort($a);
		}

		$a = array_slice($a, $limit, $onPage);
		
		return $a;
	}

	/**
	 * Returns total number of kox items
	 * 
	 * @return int
	 */
	public function getTotalNumber() {
		$catalog = UPLOADS_ROOT . '/moments/';

		//jeśli chcemy wyliczyć liczbę plików konkretnego typu stosujemy maskę *.rozszerzenie
		if (($array = glob($catalog  . '*.*')) != false) {
			return count($array);
		}
		return false;
	}
}