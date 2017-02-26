<?php

namespace Rudolf\Modules\Galleries\One\Admin;

use Rudolf\Modules\Galleries\One;

class Gallery extends One\Gallery
{
    public function editUrl()
    {
        return DIR.'/admin/galleries/edit/'.$this->id();
    }

    public function delUrl()
    {
        return DIR.'/admin/galleries/del/'.$this->id();
    }

    /**
     * Get content for textarea.
     */
    public function textarea()
    {
        return $this->content(false, false, false, true);
    }
}
