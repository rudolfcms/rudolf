<?php

namespace Rudolf\Modules\Appearance\Menu\Item;

use Rudolf\Component\Html\Text;
use Rudolf\Framework\Model\AdminModel;

class ItemAddModel extends AdminModel
{
    public function add($p)
    {
        $stmt = $this->pdo->prepare("INSERT INTO {$this->prefix}menu SET module_name = '',
          parent_id = :parent_id, title = :title, slug = :slug, caption = :caption,
          menu_type = :menu_type, item_type = :item_type, position = :position");
        $stmt->bindValue(':parent_id', $p['parent_id'], \PDO::PARAM_INT);
        $stmt->bindValue(':title', $p['title']);
        $stmt->bindValue(':slug', !empty($p['slug']) ? $p['slug'] : Text::sluger($p['title']));
        $stmt->bindValue(':caption', $p['caption']);
        $stmt->bindValue(':menu_type', $p['menu_type']);
        $stmt->bindValue(':item_type', $p['item_type']);
        $stmt->bindValue(':position', (int) $p['position'], \PDO::PARAM_INT);

        $stmt->execute();

        return $this->pdo->lastInsertId();
    }
}
