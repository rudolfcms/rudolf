<?php

namespace Rudolf\Framework\View;

use Rudolf\Component\Html\Exceptions\TemplateNotFoundException;
use Rudolf\Component\Html\Exceptions\ThemeNotFoundException;
use Rudolf\Component\Html\Foot;
use Rudolf\Component\Html\Head;
use Rudolf\Component\Plugins\DomPlugins;

abstract class BaseView
{
    /**
     * @var string Server-side path to theme catalog
     */
    public $themePath;

    /**
     * @var string
     */
    public $themeRoot;

    /**
     * @var string
     */
    public $themeName;

    /**
     * @var string
     */
    public $side;

    /**
     * @var object
     */
    public $theme;

    /**
     * Constructor.
     */
    public function __construct()
    {
        // create necessary objects
        $this->head = new Head();
        $this->foot = new Foot();
        $this->domPlugins = new DomPlugins($this->head, $this->foot);

        if (method_exists($this, 'init')) {
            $this->init();
        }
    }

    /**
     * Render page.
     *
     * @param string $side front|admin
     * @param string $type html|json
     */
    public function render($side = 'front', $type = 'html')
    {
        if ('admin' === $side) {
            $this->side = 'admin';
            $this->themeName = ADMIN_THEME;
        } else {
            $this->side = 'front';
            $this->themeName = FRONT_THEME;
        }

        $path = '/'.$this->side.'/'.$this->themeName;

        $this->themeRoot = THEMES_ROOT.$path;
        $this->themePath = THEMES.$path;

        $this->loadConfig();

        switch ($type) {
            case 'json':
                $this->renderJson();
                break;

            default:
                $this->renderHtml();
                break;
        }
    }

    /**
     * Render page in html.
     */
    private function renderHtml()
    {
        $file = $this->themeRoot.'/templates/'.$this->template.'.html.php';

        if (!file_exists($this->themeRoot)) {
            throw new ThemeNotFoundException('Theme '.$this->themeName.' does not exist');
        } elseif (is_file($file)) {
            include $file;
        } else {
            throw new TemplateNotFoundException(
                "Template file '{$this->template}' does not exist in ".$this->themeName
            );
        }
    }

    /**
     * Render page in json.
     */
    private function renderJson()
    {
        header('Content-Type: application/json');
        echo json_encode($this->data);
    }

    /**
     * Set error 404 default page title and template name.
     *
     * @return void
     */
    public function error404()
    {
        $this->pageTitle = 'error 404';
        $this->template = 'error404';
    }

    /**
     * Load theme config class.
     */
    private function loadConfig()
    {
        $file = $this->themeRoot.'/theme.php';

        if (is_file($file)) {
            include $file;
            $class = str_replace('-', '_', $this->themeName);
            $this->theme = new $class($this);
        }
    }
}
