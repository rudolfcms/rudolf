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
use Rudolf\Modules\Articles\Roll,
	Rudolf\Libs\Pagination,
	Rudolf\Feed;

class View extends Roll\View {

	public function setArticles($data) {
		$this->data = $data;
	}

	public function rss2() {
		$generator = new Feed\RSS2Generator();
		$generator->setTitle('RSS2Generator example');
		$generator->setLink('http://localhost/rudolf/feed/rss');
		$generator->setDescription('Rudolf RSS canal');

		while($this->haveArticles()) { $this->article();
			$item = new Feed\RSS2Item();
			
			$item->setTitle($this->title());
			$item->setLink('http://localhost'. $this->url());
			$item->setDescription($this->content());
			$item->setAuthor($this->author());
			$item->setPubDate($this->date('D, d M Y H:i:s T'));
			$array[] = $item->getItem();
		}

		$generator->setItems($array);

		return $generator->generate();

	}

	public function atom() {
		
	}
}
