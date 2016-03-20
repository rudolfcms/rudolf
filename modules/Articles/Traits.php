<?php
/**
 * This file is part of Rudolf articles module.
 * 
 * Article trait
 * 
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package Rudolf\Modules\Articles
 * @version 0.1
 */

namespace Rudolf\Modules\Articles;
use Rudolf\Hooks\Hooks,
	Rudolf\Html\Text,
	Rudolf\Images\Image;

trait Traits {

	/**
	 * Returns article ID
	 * 
	 * @return int
	 */
	protected function id() {
		return (int) $this->article['id'];
	}

	/**
	 * Returns category ID
	 * 
	 * @return int
	 */
	protected function categoryID() {
		return (int) $this->article['category_ID'];
	}

	/**
	 * Returns article title
	 * 
	 * @param string $type null|raw
	 * 
	 * @return string
	 */
	protected function title($type = '') {
		$title = $this->article['title'];
		if('raw' === $type) {
			return $title;
		}

		return Text::escape($title);
	}

	/**
	 * Returns the keywords
	 * 
	 * @param string $type null|raw
	 * 
	 * @return string
	 */
	protected function keywords($type = '') {
		$keywords = $this->article['keywords'];
		if('raw' === $type) {
			return $keywords;
		}

		return Text::escape($keywords);
	}

	/**
	 * Returns the description
	 * 
	 * @param string $type
	 * 
	 * @return string
	 */
	protected function description($type = '') {
		$description = $this->article['description'];
		if('raw' === $type) {
			return $description;
		}

		return Text::escape($description);
	}

	/**
	 * Returns article content
	 * 
	 * @param bool|int $truncate
	 * @param bool $stripTags
	 * @param bool $escape
	 * 
	 * @return string
	 */
	protected function content($truncate = false, $stripTags = false, $escape = false) {
		$content = $this->article['content'];

		if(true === $stripTags) {
			$content = strip_tags($content);
		}

		if(false !== $truncate and strlen($content) > $truncate) {
			$content = Text::truncate($content, $truncate);
		}

		if(true === $escape) {
			$content = Text::escape($content);
		}

		return $content;
	}

	/**
	 * Returns the author
	 * 
	 * @param bool $adder Returns adder name if fields empty
	 * 
	 * @return string
	 */
	protected function author($adder = true) {
		$author = $this->article['author'];

		// if fields is empty and $adder is true
		if(empty($author) and true === $adder) {
			$author = $this->adderFullName(false);
		}

		return Text::escape($author);
	}

	/**
	 * Returns article date
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
	 * Returns date of article added
	 * 
	 * @return string
	 */
	protected function added() {
		return $this->article['added'];
	}

	/**
	 * Returns date of last article modified
	 * 
	 * @return string
	 */
	protected function modified() {
		return $this->article['modified'];
	}

	/**
	 * Returns adder ID
	 * 
	 * @return int
	 */
	protected function adderID() {
		return (int) $this->article['adder_ID'];
	}

	/**
	 * Returns first name and surname of adder
	 * 
	 * @param string $type
	 * 
	 * @return string
	 */
	protected function adderFullName($type = '') {
		$name = $this->article['adder_first_name'] . ' ' . $this->article['adder_surname'];
		if('raw' === $type) {
			return $name;
		}

		return Text::escape($name);
	}

	/**
	 * Returns modifier ID
	 * 
	 * @return int
	 */
	protected function modifierID() {
		return (int) $this->article['modifier_ID'];
	}

	/**
	 * Returns modifier full name
	 * 
	 * @return int
	 */
	protected function modifierFullName($type = '') {
		$name = $this->article['modifier_first_name'] . ' ' . $this->article['modifier_surname'];
		if('raw' === $type) {
			return $name;
		}

		return Text::escape($name);
	}

	/**
	 * Checks whether the article has modified
	 * 
	 * @return bool
	 */
	protected function isModified() {
		return (bool) $this->article['modified'];
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
	 * Returns article slug
	 * 
	 * @return string
	 */
	protected function slug() {
		return $this->article['slug'];
	}

	/**
	 * Returns article url
	 * 
	 * @return string
	 */
	protected function url() {
		return sprintf('%1$s/%2$s/%3$s/%4$s/%5$s',
			DIR,
			'artykuly',
			$this->date('Y'),
			$this->date('m'),
			$this->article['slug']
		);
	}

	/**
	 * Returns album path
	 * 
	 * @return string
	 */
	protected function album() {
		return $this->article['album'];
	}

	/**
	 * Returns thumb path
	 * 
	 * @return string
	 */
	protected function thumb() {
		return Text::escape($this->article['thumb']);
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
	 * Returns thumbnail code or only address
	 * 
	 * @param int $w Image width
	 * @param int $h Image height
	 * @param bool $album Add album address if exists
	 * @param bool|string $alt Set alternative text
	 * 
	 * @return string
	 */
	protected function thumbnail($w = false, $h = false, $album = false, $alt = false) {
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

		$address = Image::resize($address, $w, $h);

		$image = sprintf('<img src="%1$s" alt="%4$s" width="%2$s" height="%3$s"/>',
			$address,
			$w,
			$h,
			$alt
		);

		if(true === $album and !empty($this->article['album'])) {
			$album = Text::escape($this->article['album']);
			$image = sprintf('<a href="%1$s">%2$s</a>',
				$album,
				$image
			);
		}

		return $image;
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
	 * Checks whether the article has a photos
	 * 
	 * @return bool
	 */
	protected function hasPhotos() {
		return (bool) $this->article['photos'];
	}

	/**
	 * Chcecks whether the article is published
	 * 
	 * @return bool
	 */
	protected function isPublished() {
		return (bool) $this->article['published'];
	}

	/**
	 * Returns article category anchor
	 * 
	 * @return string
	 */
	protected function category() {
		return sprintf('<a href="%1$s">%2$s</a>',
			$this->categoryUrl(),
			$this->categoryTitle()
		);
	}

	/**
	 * Returns category title
	 * 
	 * @param string $type
	 * 
	 * @return string
	 */
	protected function categoryTitle($type = '') {
		$title = $this->article['category_title'];

		if('raw' === $type) {
			return $title;
		}

		return Text::escape($title);
	}

	/**
	 * Returns category url
	 * 
	 * @return string
	 */
	protected function categoryUrl() {
		return sprintf('%1$s/%2$s/%3$s',
			DIR,
			'artykuly/kategorie',
			Text::escape($this->article['category_url'])
		);
	}

	/**
	 * Checks whether the article has a category
	 * 
	 * @return bool
	 */
	protected function hasCategory() {
		return (bool) $this->article['category_url'];
	}
}
