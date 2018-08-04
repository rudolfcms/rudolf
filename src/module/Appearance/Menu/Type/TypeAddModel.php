<?php

namespace Rudolf\Modules\Appearance\Menu\Type;

use Rudolf\Component\Html\Text;
use Rudolf\Framework\Model\AdminModel;

class TypeAddModel extends AdminModel
{

    public function add(array $p)
    {
        $stmt = $this->pdo->prepare("INSERT INTO {$this->prefix}menu_types SET 
          title = :title, description = :description, menu_type = :menu_type");
        $stmt->bindValue(':title', $p['title']);
        $stmt->bindValue(':description', $p['description']);
        $stmt->bindValue(':menu_type', Text::sluger(empty($p['menu_type']) ? $p['title'] : $p['menu_type']));

        $stmt->execute();

        return $this->pdo->lastInsertId();
    }
}
