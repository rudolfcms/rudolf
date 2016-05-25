<?php
/**
 * This file is part of pages Rudolf module.
 * 
 * Pages view
 * 
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package Rudolf\Modules\Pages
 * @version 0.1
 */

namespace Rudolf\Modules\Pages;
use Rudolf\Modules\A_front\FView,
	Rudolf\Component\Html\Navigation;

class View extends FView {
	
	use Traits;

	public function page($data) {
		$this->page = $data;
		
		$this->head->setTitle($this->title());

		$this->template = (isset($data['template'])) ? $data['template'] : 'page';
	}

	public function breadcrumb($nesting = 0) {
		$nav = new Navigation();
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
