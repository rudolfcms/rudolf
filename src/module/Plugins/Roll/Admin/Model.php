<?php

namespace Rudolf\Modules\Plugins\Roll\Admin;

use Rudolf\Component\Plugins\Manager as PluginsManager;
use Rudolf\Framework\Model\BaseModel;

class Model extends BaseModel
{
    /**
     * Returns total number of modules items.
     * @return int
     * @throws \InvalidArgumentException
     */
    public function getTotalNumber()
    {
        return count($modules = (new PluginsManager(MODULES_ROOT))->getCollection()->getAll());
    }

    /**
     * Returns array with modules list.
     *
     * @param $limit
     * @param $onPage
     *
     * @return array
     * @throws \InvalidArgumentException
     */
    public function getList($limit, $onPage)
    {
        $modules = (new PluginsManager(MODULES_ROOT))->getCollection()->getAll();

        if (empty($modules)) {
            return [];
        }

        $array = [];

        $i = 1;
        foreach ($modules as $key => $value) {
            $array[] = [
                'id' => $i++,
                'name' => $value->getName(),
                'status' => $value->getStatus(),
            ];
        }

        return array_slice($array, $limit, $onPage);
    }
}
