<?php

namespace Rudolf\Modules\Categories;

trait CategoryAddon
{
    public function setCategories($categories)
    {
        $this->categories = $categories;
    }
    public function categories()
    {
        return (array) $this->categories;
    }
}
