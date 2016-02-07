<?php
/**
 * This file is part of Rudolf articles module.
 *
 * This is the model of articles module.
 *
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package Rudolf\Modules\articles
 * @version 0.1
 */
 
namespace Rudolf\Modules\articles;

class ArticleOneView extends \Rudolf\Modules\_front\View {
	
	use ArticleTraits;

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
