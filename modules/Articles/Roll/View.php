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
use Rudolf\Modules\A_front\FView,
	Rudolf\Modules\Articles\Traits as Article;

class View extends FView {
	use Article, Traits;

	public function rollView($data, Pagination $pagination) {
		$this->data = $data;

		$this->pagination = $pagination;

		$this->template = 'index';
	}
}
