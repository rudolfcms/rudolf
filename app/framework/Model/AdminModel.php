<?php

namespace Rudolf\Framework\Model;

use Rudolf\Component\Auth\Auth;
use Rudolf\Component\Helpers\Navigation\MenuItemCollection;

class AdminModel extends BaseModel
{
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

    public function getMenuItems()
    {
        foreach (glob(MODULES_ROOT.'/*', GLOB_ONLYDIR) as $dir) {
            $dir = str_replace(MODULES_ROOT.'/', '', $dir);
            $array[] = $dir;
        }

        $collection = new MenuItemCollection();

        for ($i = 0; $i < count($array); ++$i) {
            $file = MODULES_ROOT.'/'.$array[$i].'/menu.php';

            if (file_exists($file)) {
                include $file;
            }
        }

        return $collection;
    }
}
