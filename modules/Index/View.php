<?php

namespace Rudolf\Modules\Index;
use Rudolf\Modules\Articles,
	Rudolf\Libs\Pagination;

class View extends Articles\Roll\View {
	
	public function setData($data, Pagination $pagination) {
		$this->data = $data;

		$this->pagination = $pagination;

		$this->template = 'index';
	}
}
