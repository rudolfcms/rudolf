<?php

namespace Rudolf\Component\Images;

class Image
{
    /**
     * @param string $url
     * @param int $w
     * @param int $h
     *
     * @return string
     */
    public static function resize($url, $w, $h)
    {
        if (substr($url, 0, strlen(DIR)) === DIR) {
            $url = str_replace(DIR, '', $url);
        }
        if (substr($url, 0, strlen('/content/')) === '/content/') {
            $url = str_replace('/content/', '', $url);
        }

        return CONTENT.'/cache/'.$w.'/'.$h.'/'.ltrim($url, '/');
    }
}
