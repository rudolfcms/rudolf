<?php

namespace Rudolf\Modules\Index;
use Rudolf\Modules\Articles,
	Rudolf\Component\Libs\Pagination;

class View extends Articles\Roll\View {
	
	public function setData($data, Pagination $pagination) {
		$this->rollView($data, $pagination);

		$page = $pagination->getPageNumber();
		$allPages = $pagination->getAllPages();

		if(1 !== $page) {
			$this->head->setTitle(sprintf(_('Page %1$s of %2$s'), $page, $allPages));
		}

		$this->template = 'index';
	}
}
