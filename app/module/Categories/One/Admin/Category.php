<?php
namespace Rudolf\Modules\Categories\One\Admin;

use Rudolf\Modules\Categories\One;

class Category extends One\Category
{
    public function editUrl()
    {
        return DIR . '/admin/categories/edit/' . $this->id();
    }

    public function delUrl()
    {
        return DIR . '/admin/categories/del/' . $this->id();
    }
}
