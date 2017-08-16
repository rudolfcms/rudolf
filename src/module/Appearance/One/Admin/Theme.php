<?php

namespace Rudolf\Modules\Appearance\One\Admin;

class Theme
{
    /**
     * @var array Theme data
     */
    protected $theme;

    /**
     * Constructor.
     *
     * @param array $theme
     */
    public function __construct($theme = [])
    {
        $this->setData($theme);
    }

    /**
     * Set theme data.
     *
     * @param array $theme
     *
     * @return array
     */
    public function setData($theme)
    {
        $this->theme = array_merge(
            [
                'id' => 0,
                'path' => '',
                'name' => '',
                'full-name' => '',
                'description' => '',
                'author' => '',
                'version' => '',
                'active' => false,
            ],
            (array) $theme
        );

        return $this->theme;
    }

    public function id()
    {
        return (int) $this->theme['id'];
    }

    public function path()
    {
        return $this->theme['path'];
    }

    public function urlPath()
    {
        return str_replace(APP_ROOT, '', $this->theme['path']);
    }

    public function fullName()
    {
        return $this->theme['full-name'];
    }

    public function name()
    {
        return $this->theme['name'];
    }

    public function description()
    {
        return $this->theme['description'];
    }

    public function author()
    {
        return $this->theme['author'];
    }

    public function version()
    {
        return $this->theme['version'];
    }

    public function isActive()
    {
        return $this->theme['active'];
    }
}
