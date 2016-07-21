<?php

namespace Rudolf\Framework\Model;

use Rudolf\Component\Auth\Auth;
use Rudolf\Component\Helpers\Navigation\ModulesMenu;

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

    /**
     * @return array
     */
    public function getMenuItems()
    {
        $menu = new ModulesMenu();

        return $menu->getMenuItems();
    }
}
