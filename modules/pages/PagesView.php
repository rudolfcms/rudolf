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

class PagesView extends \Rudolf\Modules\_front\View {
	
	use PageTraits;

	public function page($data) {
		$this->template = (isset($data['template'])) ? $data['template'] : 'page';
		$this->page = $data;
	}

	public function breadcrumb($nesting = 0) {
		$nav = new \Rudolf\Html\Navigation();
		$pagesList = $this->pagesList;
		$aAddress = $this->aAddress;
		
		$navigation = $nav->createBreadcrumbsNavigation(0, $pagesList, $aAddress, $nesting);

		return $navigation;
	}

	public function setBreadcrumbsData($list, $aAddress) {
		$this->pagesList = $list;
		$this->aAddress = $aAddress;
	}
}
