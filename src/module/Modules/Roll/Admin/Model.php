<?php

namespace Rudolf\Modules\Modules\Roll\Admin;

use Rudolf\Component\Modules\Manager as ModulesManager;
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
        return count($modules = (new ModulesManager(MODULES_ROOT))->getCollection()->getAll()) - 1;
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
        $modules = (new ModulesManager(MODULES_ROOT))->getCollection()->getAll();

        $array = [];

        $i = 1;
        foreach ($modules as $key => $value) {

            // prevent to disable this module and dashboard
            $name = $value->getName();
            if ('Modules' !== $name && 'Dashboard' !== $name) {
                $array[] = [
                    'id' => $i++,
                    'name' => $value->getName(),
                    'status' => $value->getStatus(),
                ];
            }
        }

        return array_slice($array, $limit, $onPage);
    }
}
