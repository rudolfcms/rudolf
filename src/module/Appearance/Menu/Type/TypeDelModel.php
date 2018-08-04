<?php

namespace Rudolf\Modules\Appearance\Menu\Type;

use Rudolf\Framework\Model\AdminModel;

class TypeDelModel extends AdminModel
{
    public function del($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->prefix}menu_types WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
