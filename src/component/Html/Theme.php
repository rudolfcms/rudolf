<?php

namespace Rudolf\Component\Html;

use Rudolf\Framework\View\BaseView;

abstract class Theme
{
    const VERSION = '0.1.0';

    const NAME = 'undefined';

    const DESCRIPTION = 'null';

    const AUTHOR = 'user@host';

    /**
     * @var BaseView
     */
    private $view;

    /**
     * @var string
     */
    private $themePath;

    /**
     * @var string
     */
    protected $path;

    /**
     * Theme constructor.
     * @param BaseView $view
     */
    public function __construct(BaseView $view)
    {
        $this->view = $view;
        $this->themePath = $view->themePath;
        $this->path = $this->themePath; // alias

        if (method_exists($this, 'init')) {
            $this->init();
        }
    }

    /**
     * @param string $code
     */
    public function addHeadBefore($code)
    {
        $this->view->head->setBefore($code);
    }

    /**
     * @param string $code
     */
    public function addHeadAfter($code)
    {
        $this->view->head->setAfter($code);
    }

    /**
     * @param string $url
     * @param string $version
     */
    public function addStylesheet($url, $version = '')
    {
        $this->view->head->setStylesheet($url, $version);
    }

    /**
     * @param string $url
     * @param string $target
     * @param string $version
     */
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

    /**
     * @param string $code
     */
    public function addFootBefore($code)
    {
        $this->view->foot->setBefore($code);
    }

    /**
     * @param string $html
     */
    public function addFootAfter($html)
    {
        $this->view->foot->setAfter($html);
    }
}
