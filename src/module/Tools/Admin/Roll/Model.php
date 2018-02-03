<?php

namespace Rudolf\Modules\Tools\Admin\Roll;

class Model
{
    private $tools;

    public function __construct()
    {
        $this->tools = [
            [
                'name' => 'Database dump',
                'slug' => 'db-dump',
            ],
        ];
    }

    /**
     * Returns total number of modules items.
     * @return int
     */
    public function getTotalNumber()
    {
        return count($this->tools);
    }

    /**
     * Returns array with modules list.
     *
     * @param $limit
     * @param $onPage
     *
     * @return array|bool
     */
    public function getList($limit, $onPage)
    {
        if (empty($this->tools)) {
            return false;
        }

        return array_slice($this->tools, $limit, $onPage);
    }
}
