<?php

/**
 * This file is part of lcms.
 * 
 * Resize images, cache and other.
 * 
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package lcms\Images
 * @version 0.1
 */

namespace lcms\Images;

class Image {
	
	public static function resize($url, $w, $h) {
		return LDIR . '/tt.php?w='. $w .'&amp;h='. $h .'&amp;src='. $url;
	}
}
