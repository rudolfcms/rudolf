<?php

namespace Rudolf\Modules\Categories;

trait CategoryAddon
{
    /**
     * @var array
     */
    protected $categories;

    /**
     * @param array $categories
     */
    public function setCategories(array $categories)
    {
        if (false === $categories) {
            $this->categories = [];

            return;
        }
        $this->categories = $categories;
    }

    /**
     * @return array
     */
    public function categories()
    {
        return $this->categories;
    }
}
