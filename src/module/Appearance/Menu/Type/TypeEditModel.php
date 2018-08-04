<?php

namespace Rudolf\Modules\Appearance\Menu\Type;

use Rudolf\Framework\Model\AdminModel;

class TypeEditModel extends AdminModel
{
    public function getMenuTypeById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->prefix}menu_types WHERE id=?");
        $stmt->execute([$id]);
        $res = $stmt->fetch(\PDO::FETCH_OBJ);

        return new MenuType([
            'id' => $res->id,
            'title' => $res->title,
            'description' => $res->description,
            'menu_type' => $res->menu_type,
        ]);
    }

    public function edit($id, $p)
    {
        $stmt = $this->pdo->prepare("UPDATE {$this->prefix}menu_types SET
            title = :title, description = :description, menu_type = :menu_type WHERE id = :id");
        $stmt->bindValue(':title', $p['title']);
        $stmt->bindValue(':description', $p['description']);
        $stmt->bindValue(':menu_type', $p['menu_type']);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);

        return $stmt->execute();
    }
}
