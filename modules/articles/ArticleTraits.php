<?php

namespace Rudolf\Modules\articles;

use Rudolf\Hooks\Hooks,
	Rudolf\Html\Text;

trait ArticleTraits {

	/**
	 * Return article title
	 * 
	 * @return string
	 */
	protected function title($type = 'beautify') {
		$title = $this->article['title'];

		if('raw' === $type) {
			return $title;
		}

		$title = str_replace(' w ', ' w&nbsp;', $title);
		$title = str_replace(' i ', ' i&nbsp;', $title);
		$title = str_replace(' o ', ' o&nbsp;', $title);
		$title = str_replace(' a ', ' a&nbsp;', $title);

		return $title;
	}

	/**
	 * Return article content
	 * 
	 * @param bool|int $truncate
	 * @param bool $stripTags
	 * 
	 * @return string
	 */
	protected function content($truncate = false, $stripTags = false) {
		$content = $this->article['content'];

		if(true === $stripTags) {
			$content = strip_tags($content);
		}

		if(false !== $truncate and strlen($content) > $truncate) {
			$content = Text::truncate($content, $truncate);
		}

		return $content;
	}

	/**
	 * Return article date
	 * 
	 * @param bool|string $format
	 * @param string $style normal|locale
	 * 
	 * @return string
	 */
	protected function date($format = false, $style = 'normal') {
		switch ($style) {
			case 'locale': // http://php.net/manual/en/function.strftime.php
					$locale = $this->theme->article['date']['default']['locale'];
				$format = ($format) ? $format : (isset($locale)) ? $locale : '%V-%G-%Y';
				$date = strftime($format, strtotime($this->article['date']));
				break;
			
			default: // http://php.net/manual/en/datetime.formats.date.php
					if(is_object($this->theme)) {
						$normal = $this->theme->article['date']['default']['normal'];
					} else {$normal = false;}
				$format = (!$format) ? ((isset($normal)) ? $normal : 'Y-m-d H:i:s') : $format;
				$date = date_format(date_create($this->article['date']), $format);
				break;
		}

		if(empty($this->article['date'])) {
			return false;
		}
		
		$date = Hooks::apply_filters('date_format_filter', $date);

		$month = [
			'styczeń' => 'stycznia', // 01
			'luty' => 'lutego', // 02
			'marzec' => 'marca', // 03
			'kwiecień' => 'kwietnia', // 04
			'maj' => 'maja', // 05
			'czerwiec' => 'czerwca', // 06
			'lipiec' => 'lipca', // 07
			'sierpień' => 'sierpnia', // 08
			'wrzesień' => 'września', // 09
			'październik' => 'października', // 10
			'listopad' => 'listopada', // 11
			'grudzień' => 'grudnia' // 12
		];

		foreach ($month as $key => $value) {
			$date = str_replace($key, $value, $date);
		}

		return $date;
	}

	/**
	 * Returns the keywords
	 * 
	 * @return string
	 */
	protected function keywords() {
		return Text::escape($this->article['keywords']);
	}

	/**
	 * Returns the description
	 * 
	 * @return string
	 */
	protected function description() {
		return Text::escape($this->article['description']);
	}

	/**
	 * Returns the author
	 * 
	 * @return string
	 */
	protected function author() {

		return ($this->article['author']) ? $this->article['author'] : $this->article['first_name'] . ' ' . $this->article['surname'];
		
	}

	/**
	 * Checks whether the article has a photos
	 * 
	 * @return bool
	 */
	protected function hasPhotos() {
		return (bool) $this->article['photos'];
	}

	/**
	 * Returns the number of photos
	 * 
	 * @return int
	 */
	protected function photos() {
		return (int) $this->article['photos'];
	}

	/**
	 * Returns the number of views
	 * 
	 * @return int
	 */
	protected function views() {
		return (int) $this->article['views'];
	}

	/**
	 * Checks whether the article has a category
	 * 
	 * @return bool
	 */
	protected function hasCategory() {
		return (bool) $this->article['category_url'];
	}

	/**
	 * Checks whether the article has a thumbnail
	 * 
	 * @return bool
	 */
	protected function hasThumbnail() {
		return (bool) $this->article['thumb'];
	}

	/**
	 * Return thumbnail code or only address
	 * 
	 * @param int $w
	 * @param int $h
	 * @param bool $src
	 * @param bool|string $alt
	 * 
	 * @return string
	 */
	protected function thumbnail($w, $h, $src = false, $alt = false) {
		$w = ($w) ? $w : $this->theme->article['thumb']['width'];
		$h = ($h) ? $h : $this->theme->article['thumb']['height'];
		$alt = ($alt) ? $alt : Text::escape($this->title('raw'));

		$address = $this->article['thumb'];

		if(!$this->hasThumbnail() and $image = $this->theme->article['thumb']['default']) {
			$address = $this->themePath .'/'. $image;
		} elseif(!$this->hasThumbnail()) {
			return false;
		}

		$address = \lcms\Images\Image::resize($address, $w, $h);

		if(true === $src) {
			return $address;
		}

		return sprintf('<img src="%1$s" alt="%4$s" width="%2$s" height="%3$s"/>', $address, $w, $h, $alt);
	}

	/**
	 * Return article url
	 * 
	 * @return string
	 */
	protected function url() {
		return DIR . '/artykuly/'. $this->date('Y') .'/'. $this->date('m') .'/'. $this->article['slug'];
	}

	/**
	 * Return article category
	 * 
	 * @return string
	 */
	protected function category() {
		$address = DIR . '/artykuly/kategorie/'. $this->article['category_url'];
		
		return sprintf('<a href="%1$s">%2$s</a>', $address, $this->article['category_title']);
	}
}
