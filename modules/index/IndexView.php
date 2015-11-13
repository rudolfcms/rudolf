<?php

namespace Modules\index;
use lcms\Abstracts\View;

class IndexView extends \Modules\articles\ArticlesListView {
	
	public function setData($data) {
		$this->data = $data;

		$this->template = 'index';
	}
}
