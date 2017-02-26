<?php

namespace Rudolf\Modules\Albums\Category\One\Admin;

use Rudolf\Modules\Albums\Category\One;
use Rudolf\Modules\Categories\One\ICategory;

class Category extends One\Category implements ICategory
{
    public function editUrl()
    {
        return DIR.'/admin/albums/categories/edit/'.$this->id();
    }

    public function delUrl()
    {
        return DIR.'/admin/albums/categories/del/'.$this->id();
    }
}
