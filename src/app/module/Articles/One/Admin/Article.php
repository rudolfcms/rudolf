<?php

namespace Rudolf\Modules\Articles\One\Admin;

use Rudolf\Modules\Articles\One;

class Article extends One\Article
{
    public function editUrl()
    {
        return DIR.'/admin/articles/edit/'.$this->id();
    }

    public function delUrl()
    {
        return DIR.'/admin/articles/del/'.$this->id();
    }

    /**
     * Get content for textarea.
     */
    public function textarea()
    {
        return $this->content(false, false, false, true);
    }

    public function addCategory()
    {
        return DIR.'/admin/articles/categories/add';
    }
}
