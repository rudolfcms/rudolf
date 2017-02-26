<?php

namespace Rudolf\Modules\Modules\Roll\Admin;

use Rudolf\Component\Modules\Manager as ModulesManager;
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
        return count($modules = (new ModulesManager(MODULES_ROOT))->getCollection()->getAll()) - 1;
    }

    /**
     * Returns array with modules list.
     *
     * @return array
     */
    public function getList()
    {
        $modules = (new ModulesManager(MODULES_ROOT))->getCollection()->getAll();

        $i = 1;
        foreach ($modules as $key => $value) {

            // prevent to disable this module and dashboard
            if ('Modules' !== $value->getName() and 'Dashboard' !== $value->getName()) {
                $array[] = [
                    'id' => $i++,
                    'name' => $value->getName(),
                    'status' => $value->getStatus(),
                ];
            }
        }

        return $array;
    }
}
