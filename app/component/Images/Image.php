<?php

namespace Rudolf\Component\Images;

class Image
{
    public static function resize($url, $w, $h)
    {
        return CONTENT.'/cache/'.$w.'/'.$h.'/'.strtr(base64_encode($url), '+/=', '-_');
    }
}
