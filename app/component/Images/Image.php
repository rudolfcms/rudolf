<?php

namespace Rudolf\Component\Images;

class Image
{
    public static function resize($url, $w, $h)
    {
        $url = str_replace('/content/', '', $url);
        return CONTENT.'/cache/'.$w.'/'.$h.'/'.ltrim($url, '/');
    }
}
