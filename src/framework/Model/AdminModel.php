<?php

namespace Rudolf\Framework\Model;

use Rudolf\Component\Auth\Auth;
use Rudolf\Component\Helpers\Navigation\MenuItemCollection;
use Rudolf\Component\Modules\Manager as ModulesManager;

class AdminModel extends BaseModel
{
    /**
     * @var Auth
     */
    protected static $auth;

    /**
     * Returns Auth object.
     *
     * @return Auth
     */
    public function getAuth()
    {
        if (empty(self::$auth)) {
            self::$auth = new Auth($this->pdo, $this->prefix);
        }

        return self::$auth;
    }

    /**
     * @return MenuItemCollection
     */
    public function getMenuItems()
    {
        $modules = (new ModulesManager(MODULES_ROOT))->getCollection()->getActive();

        $collection = new MenuItemCollection();

        foreach ($modules as $key => $value) {
            $file = MODULES_ROOT.'/'.$value->getName().'/menu.php';

            if (is_file($file)) {
                include $file;
            }
        }

        return $collection;
    }
}
