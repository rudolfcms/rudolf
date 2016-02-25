<?php

namespace Rudolf\Modules\Articles;

use Rudolf\Hooks\Hooks,
	Rudolf\Html\Text;

trait Traits {

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
	protected function date($format = false, $style = 'normal', $inflected = true) {
		switch ($style) {
			case 'locale': // http://php.net/manual/en/function.strftime.php
					if(is_object($this->theme)) {
						$locale = $this->theme->article['date']['default']['locale'];
					} else {$locale = null;}
				$format = (!$format) ? ((isset($locale)) ? $locale : '%D') : $format;
				$date = strftime($format, strtotime($this->article['date']));
				break;
			
			default: // http://php.net/manual/en/datetime.formats.date.php
					if(is_object($this->theme)) {
						$normal = $this->theme->article['date']['default']['normal'];
					} else {$normal = null;}
				$format = (!$format) ? ((isset($normal)) ? $normal : 'Y-m-d H:i:s') : $format;
				$date = date_format(date_create($this->article['date']), $format);
				break;
		}

		if(empty($this->article['date'])) {
			return false;
		}
		
		$date = Hooks::apply_filters('date_format_filter', $date);

		if(true === $inflected) {
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
	 * @param int $w Image width
	 * @param int $h Image height
	 * @param bool $src Set true to get only image address
	 * @param bool $album Add album address if exists
	 * @param bool|string $alt Set alternative text
	 * 
	 * @return string
	 */
	protected function thumbnail($w = false, $h = false, $album = false, $src = false, $alt = false) {
		$w = ($w) ? $w : ((is_object($this->theme) ? $this->theme->article['thumb']['width'] : 100));
		$h = ($h) ? $h : ((is_object($this->theme) ? $this->theme->article['thumb']['height'] : 100));
		$alt = ($alt) ? $alt : Text::escape($this->title('raw'));

		$address = Text::escape($this->article['thumb']);

		if(is_object($this->theme)) {
			if(!$this->hasThumbnail() and $image = $this->theme->article['thumb']['default']) {
				$address = $this->themePath .'/'. $image;
			} elseif(!$this->hasThumbnail()) {
				return false;
			}
		}

		$address = \Rudolf\Images\Image::resize($address, $w, $h);

		if(true === $src) {
			return $address;
		}

		$image = sprintf('<img src="%1$s" alt="%4$s" width="%2$s" height="%3$s"/>', $address, $w, $h, $alt);

		if(true === $album and !empty($this->article['album'])) {
			$album = Text::escape($this->article['album']);
			$image = sprintf('<a href="%1$s">%2$s</a>', $album, $image);
		}

		return $image;
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
