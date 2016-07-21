<?php

namespace Rudolf\Component\Images;

class Image
{
    public static function resize($url, $w, $h)
    {
        return CONTENT.'/tt.php?w='.$w.'&amp;h='.$h.'&amp;src='.$url;
    }
}
