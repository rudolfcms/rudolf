<?php

namespace Rudolf\Modules\index;
use Rudolf\Abstracts\View;

class IndexView extends \Rudolf\Modules\articles\ArticlesListView {
	
	public function setData($data, $paginationInfo) {
		$this->data = $data;

		$this->paginationInfo = $paginationInfo;

		$this->template = 'index';
	}
}
