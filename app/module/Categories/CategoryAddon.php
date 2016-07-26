<?php

namespace Rudolf\Modules\Categories;

trait CategoryAddon
{
    public function setCategories($categories)
    {
        if (false === $categories) {
            $this->categories = [];
            return;
        }
        $this->categories = $categories;
    }
    public function categories()
    {
        return $this->categories;
    }
}
