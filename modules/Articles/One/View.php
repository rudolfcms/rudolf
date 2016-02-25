<?php
/**
 * This file is part of Rudolf articles module.
 *
 * This is the model of articles module.
 *
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package Rudolf\Modules\Articles\One
 * @version 0.1
 */
 
namespace Rudolf\Modules\Articles\One;
use Rudolf\Modules\A_front\FView,
	Rudolf\Modules\Articles\Traits;

class View extends FView {
	
	use Traits;

	/**
	 * @var array
	 */
	protected $article;

	/**
	 * Set articles data
	 * 
	 * @param array $article
	 */
	public function setData($article) {
		$this->article = $article;

		$this->template = (isset($article['template'])) ? $article['template'] : 'article-once';
	}
}
