<?php

namespace Rudolf\Modules\Pages\One\Admin;

use Rudolf\Framework\Model\AdminModel;

class DelModel extends AdminModel
{
    /**
     * Delete page.
     *
     * @param int $id Article ID
     */
    public function delete($id)
    {
        $query = $this->pdo->prepare("DELETE FROM {$this->prefix}pages WHERE id = :id");
        $query->bindValue(':id', $id, \PDO::PARAM_INT);

        return $query->execute();
    }
}
