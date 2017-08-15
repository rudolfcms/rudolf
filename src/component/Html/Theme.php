<?php

namespace Rudolf\Component\Html;

abstract class Theme
{
    const VERSION = '0.1.0';

    const NAME = 'undefined';

    const DESCRIPTION = 'null';

    const AUTHOR = 'user@host';

    public function __construct($view)
    {
        $this->view = $view;
        $this->themePath = $view->themePath;
        $this->path = $this->themePath; // alias

        if (method_exists($this, 'init')) {
            $this->init();
        }
    }
    public function addHeadBefore($code)
    {
        $this->view->head->setBefore($code);
    }
    public function addHeadAfter($code)
    {
        $this->view->head->setAfter($code);
    }
    public function addStylesheet($url, $version = '')
    {
        $this->view->head->setStylesheet($url, $version);
    }
    public function addScript($url, $target = 'foot', $version = '')
    {
        switch ($target) {
            case 'head':
                $this->view->head->setScript($url, $version);
                break;

            default:
                $this->view->foot->setScript($url, $version);
                break;
        }
    }
    public function addFootBefore($code)
    {
        $this->view->foot->setBefore($code);
    }
    public function addFootAfter($code)
    {
        $this->view->foot->setAfter($code);
    }
}
