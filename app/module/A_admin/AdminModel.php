<?php
namespace Rudolf\Modules\A_admin;

use Rudolf\Framework\Model\BaseModel;
use Rudolf\Component\Auth\Auth;

class AdminModel extends BaseModel
{
    protected static $auth;

    /**
     * Returns Auth object 
     * 
     * @return Auth
     */
    public function getAuth()
    {
        if(empty(self::$auth)) {
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
