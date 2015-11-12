<?php
/**
 * This file is part of lcms articles module.
 * 
 * This is the model of articles module.
 * 
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package lcms
 * @version 0.1
 */
 
namespace Modules\articles;
use lcms\Abstracts\View;

class ArticleOneView extends View {

	protected $article;

	public function setData($article) {
		$this->article = $article;
		$this->template = (isset($article['template'])) ? $article['template'] : 'article-once';
	}

	protected function title() {

		$title = $this->article['title'];

		$title = str_replace('w ', 'w&nbsp;', $title);
		$title = str_replace('i ', 'i&nbsp;', $title);
		$title = str_replace('o ', 'o&nbsp;', $title);
		$title = str_replace('a ', 'a&nbsp;', $title);

		return $title;
	}

	protected function content() {
		return $this->article['content'];
	}

	protected function date($format = false) {
		if(false === $format) {
			$format = 'Y-m-d H:i:s';
		}

		$date = date_format(date_create($this->article['date']), $format);

		//$date = $this->hooks->apply_filters('date_format_filter', $date);

		return $date;
	}

	protected function keywords() {
		return $this->article['keywords'];
	}

	protected function description() {
		return $this->article['description'];
	}

	protected function author() {
		return $this->article['author'];
	}

	protected function hasPhotos() {
		return (bool) $this->article['photos'];
	}

	protected function photos() {
		return (int) $this->article['photos'];
	}

	protected function views() {
		return (int) $this->article['views'];
	}

	protected function hasCategory() {
		return (bool) $this->article['category_url'];
	}
}
