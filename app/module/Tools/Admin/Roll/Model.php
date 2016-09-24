<?php

namespace Rudolf\Modules\Tools\Admin\Roll;

class Model
{
    public function __construct()
    {
        $this->tools = [
            [
                'name' => 'Database dump',
                'slug' => 'db-dump',
            ]
        ];
    }

    /**
     * Returns total number of modules items.
     * 
     * @param array|string $where
     * 
     * @return int
     */
    public function getTotalNumber()
    {
        return count($this->tools);
    }

    /**
     * Returns array with modules list.
     *
     * @return array
     */
    public function getList()
    {
        if (empty($this->tools)) {
            return false;
        }

        return $this->tools;
    }
}
