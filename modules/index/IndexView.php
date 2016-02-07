<?php

namespace Rudolf\Modules\index;

class IndexView extends \Rudolf\Modules\articles\ArticlesListView {
	
	public function setData($data, \Rudolf\Libs\Pagination $pagination) {
		$this->data = $data;

		$this->pagination = $pagination;

		$this->template = 'index';
	}
}
