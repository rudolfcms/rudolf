<?php

namespace Modules\index;
use lcms\Abstracts\View;

class IndexView extends \Modules\articles\ArticlesListView {
	
	public function setData($data, $paginationInfo) {
		$this->data = $data;

		$this->paginationInfo = $paginationInfo;

		$this->template = 'index';
	}
}
