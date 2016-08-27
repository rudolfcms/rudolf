<?php

namespace Rudolf\Modules\Plugins\Roll\Admin;

use Rudolf\Component\Plugins\Manager as PluginsManager;
use Rudolf\Framework\Model\BaseModel;

class Model extends BaseModel
{
    /**
     * Returns total number of modules items.
     * 
     * @param array|string $where
     * 
     * @return int
     */
    public function getTotalNumber()
    {
        return count($modules = (new PluginsManager(MODULES_ROOT))->getCollection()->getAll());
    }

    /**
     * Returns array with modules list.
     *
     * @return array
     */
    public function getList()
    {
        $modules = (new PluginsManager(MODULES_ROOT))->getCollection()->getAll();

        if (empty($modules)) {
            return false;
        }

        $i = 1;
        foreach ($modules as $key => $value) {
            $array[] = [
                'id' => $i++,
                'name' => $value->getName(),
                'status' => $value->getStatus(),
            ];
        }

        return $array;
    }
}
