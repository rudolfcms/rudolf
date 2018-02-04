<?php

namespace Rudolf\Modules\Appearance\Menu;

use Rudolf\Framework\Model\AdminModel;

class MenuModel extends AdminModel
{
    public function getMenuTypes()
    {
        $stmt = $this->pdo->query("SELECT * FROM {$this->prefix}menu_types");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
