<?php

namespace Rudolf\Modules\Pages\One\Admin;

use Rudolf\Modules\Pages\One;

class Page extends One\Page
{
    public function editUrl()
    {
        return DIR.'/admin/pages/edit/'.$this->id();
    }

    public function delUrl()
    {
        return DIR.'/admin/pages/del/'.$this->id();
    }

    /**
     * Get content for textarea.
     */
    public function textarea()
    {
        return $this->content(false, false, false, true);
    }
}
