<?php
/**
 * This file is part of Rudolf articles module.
 * 
 * This is the model of articles module.
 * 
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package Rudolf\Modules\Articles\Feed
 * @version 0.1
 */
 
namespace Rudolf\Modules\Articles\Feed;
use Rudolf\Modules\Articles\Roll\Roll;
use Rudolf\Modules\A_front\FView;
use Rudolf\Component\Libs\Pagination;
use Rudolf\Component\Feed;

class View extends FView {

	public function setArticles($data, $pagination) {
		$this->data = $data;
		$this->pagination = $pagination;
	}

	public function rss2() {
		$generator = new Feed\RSS2Generator();
		$generator->setTitle('RSS2Generator example');
		$generator->setLink('http://zsrokietnica.project/feed/rss');
		$generator->setDescription('Rudolf RSS canal');

		$roll = new Roll($this->data, $this->pagination);

		while($roll->haveArticles()) { $article = $roll->article();
			$item = new Feed\RSS2Item();
			
			$item->setTitle($article->title());
			$item->setLink('http://zsrokietnica.project'. $article->url());
			$item->setDescription($article->content());
			$item->setAuthor($article->author());
			$item->setPubDate($article->date('D, d M Y H:i:s T'));
			$array[] = $item->getItem();
		}

		$generator->setItems($array);

		return $generator->generate();

	}

	public function atom() {
		
	}
}
