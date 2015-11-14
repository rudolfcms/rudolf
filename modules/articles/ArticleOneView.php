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

	/**
	 * Return article title
	 * 
	 * @return string
	 */
	protected function title() {

		$title = $this->article['title'];

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
			$content = substr($content, 0, $truncate);
			$content = trim(trim($content), ',') . '...';
		}

		return $content;
	}

	/**
	 * Return article date
	 * 
	 * @param bool|string $format
	 * 
	 * @return string
	 */
	protected function date($format = false) {
		if(false === $format) {
			$format = 'Y-m-d H:i:s';
		}

		if(empty($this->article['date'])) {
			return false;
		}

		$date = date_format(date_create($this->article['date']), $format);

		//$date = $this->hooks->apply_filters('date_format_filter', $date);

		return $date;
	}

	/**
	 * Returns the keywords
	 * 
	 * @return string
	 */
	protected function keywords() {
		return $this->article['keywords'];
	}

	/**
	 * Returns the description
	 * 
	 * @return string
	 */
	protected function description() {
		return $this->article['description'];
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
		$alt = ($alt) ? $alt : $this->title();

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
		return LDIR . '/artykuly/'. $this->date('Y') .'/'. $this->date('m') .'/'. $this->article['slug'];
	}

	/**
	 * Return article category
	 * 
	 * @return string
	 */
	protected function category() {
		$address = LDIR . '/artykuly/kategorie/'. $this->article['category_url'];
		
		return sprintf('<a href="%1$s">%2$s</a>', $address, $this->article['category_title']);
	}
}
