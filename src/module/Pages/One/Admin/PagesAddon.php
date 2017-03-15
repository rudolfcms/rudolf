<?php

namespace Rudolf\Modules\Pages\One\Admin;

trait PagesAddon
{
    public function setPages($pages)
    {
        if (false === $pages) {
            $this->pages = [];

            return;
        }
        $this->pages = $pages;
    }
    public function pages()
    {
        return $this->pages;
    }
}
