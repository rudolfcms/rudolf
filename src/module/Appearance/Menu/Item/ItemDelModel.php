<?php

namespace Rudolf\Modules\Appearance\Menu\Item;

use Rudolf\Framework\Model\AdminModel;

class ItemDelModel extends AdminModel
{
    public function del($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->prefix}menu WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
