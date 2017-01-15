<?php

namespace Rudolf\Modules\Categories\One\Admin;

use Rudolf\Framework\Model\AdminModel;

class DelModel extends AdminModel
{
    /**
     * Delete category.
     * 
     * @param int $id Category ID
     */
    public function delete($id)
    {
        $query = $this->pdo->prepare("DELETE FROM {$this->prefix}categories WHERE id = :id");
        $query->bindValue(':id', $id, \PDO::PARAM_INT);

        return $query->execute();
    }
}
