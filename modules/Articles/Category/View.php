<?php
/**
 * This file is part of Rudolf articles module.
 * 
 * This is the model of articles module.
 * 
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package Rudolf\Modules\Articles\Category
 * @version 0.1
 */
 
namespace Rudolf\Modules\Articles\Category;
use Rudolf\Modules\A_front\FView,
	Rudolf\Modules\Articles\Roll;

class View extends FView {

	public function setData($data, $pagination, $info = false) {
		$this->roll = new Roll\Roll($data, $pagination, '/artykuly/kategorie/'. $info['slug']);
		
		$this->categoryInfo = $info;

		$page = $pagination->getPageNumber();
		$allPages = $pagination->getAllPages();

		$titleBefore = null;

		if(1 !== $page) {
			$titleBefore = sprintf(_('Page %1$s of %2$s'), $page, $allPages) .' ';
		}

		$this->head->setTitle($titleBefore . $this->categoryTitle(true));

		$this->template = (isset($data['template'])) ? $data['template'] : 'category';
	}

	/**
	 * Returns category title
	 * 
	 * @param bool $strip
	 * 
	 * @return string
	 */
	public function categoryTitle($strip = false) {
		$title = _('Artykuły z kategorii') . ' <i>' . $this->categoryInfo['title'] . '</i>';

		if(true === $strip) {
			return strip_tags($title);
		}

		return $title;
	}

	/**
	 * Returns category description
	 * 
	 * @return string
	 */
	public function categoryDescription() {
		return $this->categoryInfo['description'];
	}
}
