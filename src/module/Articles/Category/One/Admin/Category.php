<?php

namespace Rudolf\Modules\Articles\Category\One\Admin;

use Rudolf\Modules\Articles\Category\One;
use Rudolf\Modules\Categories\One\ICategory;

class Category extends One\Category
{
    public function editUrl()
    {
        return DIR.'/admin/articles/categories/edit/'.$this->id();
    }

    public function delUrl()
    {
        return DIR.'/admin/articles/categories/del/'.$this->id();
    }
}
