<?php

namespace Rudolf\Component\Html;

class Url
{
    /**
     * @return string
     */
    public function getOrigin()
    {
        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http');
        $url .= '://'.$_SERVER['HTTP_HOST'];

        return $url;
    }
}
