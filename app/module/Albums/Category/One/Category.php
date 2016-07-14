<?php
namespace Rudolf\Modules\Albums\Category\One;

use Rudolf\Modules\Categories\One;

class Category extends One\Category implements One\ICategory
{
    /**
     * Returns category url
     * 
     * @return string
     */
    public function url()
    {
        return sprintf('%1$s/%2$s/%3$s/%4$s',
            DIR,
            'foto',
            'kategorie',
            $this->slug()
        );
    }
}
