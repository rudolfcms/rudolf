<?php
/**
 * This file is part of Rudolf.
 *
 * Resize images, cache and other.
 *
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package Rudolf\Component\Images
 * @version 0.1
 */

namespace Rudolf\Component\Images;

class Image {
	
	public static function resize($url, $w, $h) {
		return CONTENT . '/tt.php?w='. $w .'&amp;h='. $h .'&amp;src='. $url;
	}
}
