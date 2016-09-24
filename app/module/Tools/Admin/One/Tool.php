<?php

namespace Rudolf\Modules\Tools\Admin\One;

use Rudolf\Component\Helpers\Pagination\IItem;

class Tool implements IItem
{
    private $tool;

    public function setData($tool)
    {
        $this->tool = array_merge(
            [
                'name' => '',
                'slug' => '',
            ],
            (array) $tool
        );
    }

    public function name()
    {
        return $this->tool['name'];
    }

    public function slug()
    {
        return $this->tool['slug'];
    }
}
