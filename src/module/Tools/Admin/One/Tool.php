<?php

namespace Rudolf\Modules\Tools\Admin\One;

use Rudolf\Component\Helpers\Pagination\IItem;

class Tool implements IItem
{
    /**
     * @var array
     */
    private $tool;

    /**
     * @param array $tool
     */
    public function setData(array $tool)
    {
        $this->tool = array_merge(
            [
                'name' => '',
                'slug' => '',
            ],
            $tool
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
