<?php

namespace Rudolf\Modules\Appearance\Menu;

use Rudolf\Framework\Model\AdminModel;

class Model extends AdminModel
{
    public function getTypes()
    {
        return $this->pdo->query("SELECT * FROM {$this->prefix}menu_types")
            ->fetchAll(\PDO::FETCH_ASSOC);
    }
}
