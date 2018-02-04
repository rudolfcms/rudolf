<?php

namespace Rudolf\Modules\Appearance\Menu;

use Rudolf\Framework\Model\AdminModel;

class AddModel extends AdminModel
{
    public function add($p)
    {
        $stmt = $this->pdo->prepare("INSERT INTO {$this->prefix}menu SET module_name = '',
          parent_id = :parent_id, title = :title, slug = :slug, caption = :caption,
          menu_type = :menu_type, item_type = :item_type, position = :position");
        $stmt->bindValue(':parent_id', $p['parent_id'], \PDO::PARAM_INT);
        $stmt->bindValue(':title', $p['title']);
        $stmt->bindValue(':slug', $p['slug']);
        $stmt->bindValue(':caption', $p['caption']);
        $stmt->bindValue(':menu_type', $p['menu_type']);
        $stmt->bindValue(':item_type', $p['item_type']);
        $stmt->bindValue(':position', (int) $p['position'], \PDO::PARAM_INT);

        $stmt->execute();

        return $this->pdo->lastInsertId();
    }
}
