<?php

namespace Rudolf\Component\Images;

class Image
{
    public static function resize($url, $w, $h)
    {
        return CONTENT.'/cache/'.$w.'/'.$h.'/'.base64_url_encode($url);
    }
}

function base64_url_encode($input) {
 return strtr(base64_encode($input), '+/=', '-_');
}
