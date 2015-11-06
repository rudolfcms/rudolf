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

	protected $data;

	public function setData($data) {
		$this->data = $data;
		$this->template = (isset($data['template'])) ? $data['template'] : 'article-once';
	}

	protected function title() {
		return $this->data['title'];
	}

	protected function content() {
		return $this->data['content'];
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
		return $this->data['keywords'];
	}

	protected function description() {
		return $this->data['description'];
	}

	protected function author() {
		return $this->data['author'];
	}

	protected function hasPhotos() {
		return (bool) $this->data['photos'];
	}

	protected function photos() {
		return (int) $this->data['photos'];
	}

	protected function views() {
		return (int) $this->data['views'];
	}

	protected function hasCategory() {
		return (bool) $this->data['category_url'];
	}
}
