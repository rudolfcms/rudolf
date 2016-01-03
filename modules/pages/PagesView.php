<?php
/**
 * This file is part of pages Rudolf module.
 * 
 * Pages view
 * 
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package Rudolf\Modules\pages
 * @version 0.1
 */

namespace Rudolf\Modules\pages;
use Rudolf\Abstracts\View;

class PagesView extends View {
	
	use PageTraits;

	public function page($data) {
		$this->template = (isset($data['template'])) ? $data['template'] : 'page';
		$this->page = $data;
	}
}
