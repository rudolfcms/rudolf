<?php

namespace Rudolf\Modules\Users\One\Admin\Profile;

use Rudolf\Framework\Model\AdminModel;

class DelModel extends AdminModel
{
    public function del($id)
    {
        $query = $this->pdo->prepare("DELETE FROM {$this->prefix}users WHERE id = :id");
        $query->bindValue(':id', $id, \PDO::PARAM_INT);

        return $query->execute();
    }
}
