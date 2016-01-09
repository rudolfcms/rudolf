<?php

namespace Rudolf\Modules\index;
use Rudolf\Abstracts\View,
	Rudolf\Libs\Pagination;

class IndexView extends \Rudolf\Modules\articles\ArticlesListView {
	
	public function setData($data, Pagination $pagination) {
		$this->data = $data;

		$this->pagination = $pagination;

		$this->template = 'index';
	}
}
