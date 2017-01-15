<?php

namespace Rudolf\Component\Html;

class Url
{
    public function getOrigin($useForwardedHost = false)
    {
        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http');
        $url .= '://'.$_SERVER['HTTP_HOST'];

        return $url;
    }
}
