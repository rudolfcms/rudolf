<?php

namespace Rudolf\Modules\Appearance\Menu;

use Rudolf\Framework\Model\AdminModel;

class DelModel extends AdminModel
{
    public function del($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->prefix}menu WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
