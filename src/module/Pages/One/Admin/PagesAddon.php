<?php

namespace Rudolf\Modules\Pages\One\Admin;

trait PagesAddon
{
    /**
     * @var array
     */
    protected $pages;

    /**
     * @param array $pages
     */
    public function setPages(array $pages)
    {
        if (false === $pages) {
            $this->pages = [];

            return;
        }
        $this->pages = $pages;
    }

    /**
     * @return array
     */
    public function pages()
    {
        return $this->pages;
    }
}
