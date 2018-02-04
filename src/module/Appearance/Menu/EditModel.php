<?php

namespace Rudolf\Modules\Appearance\Menu;

use Rudolf\Framework\Model\AdminModel;

class EditModel extends AdminModel
{
    public function getInfo($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->prefix}menu WHERE id=?");
        $stmt->execute([$id]);
        $value = $stmt->fetch(\PDO::FETCH_ASSOC);

        return new MenuItem([
            'id' => $value['id'],
            'parent_id' => $value['parent_id'],
            'title' => $value['title'],
            'slug' => $value['slug'],
            'caption' => $value['caption'],
            'menu_type' => $value['menu_type'],
            'item_type' => $value['item_type'],
            'position' => $value['position'],
        ]);
    }

    public function edit($id, $p)
    {
        $stmt = $this->pdo->prepare("UPDATE {$this->prefix}menu SET
            parent_id = :parent_id, title = :title, slug = :slug, caption = :caption, menu_type = :menu_type,
            item_type = :item_type, position = :position WHERE id = :id");
        $stmt->bindValue(':parent_id', $p['parent_id'], \PDO::PARAM_INT);
        $stmt->bindValue(':title', $p['title']);
        $stmt->bindValue(':slug', $p['slug']);
        $stmt->bindValue(':caption', $p['caption']);
        $stmt->bindValue(':menu_type', $p['menu_type']);
        $stmt->bindValue(':item_type', $p['item_type']);
        $stmt->bindValue(':position', (int) $p['position'], \PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);

        return $stmt->execute();
    }
}
