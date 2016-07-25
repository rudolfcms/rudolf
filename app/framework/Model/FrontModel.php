<?php

namespace Rudolf\Framework\Model;

use Rudolf\Component\Helpers\Navigation\MenuItemCollection;
use Rudolf\Component\Helpers\Navigation\MenuItem;

class FrontModel extends BaseModel
{
    public function getMenuItems()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->prefix}menu");
        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $collection = new MenuItemCollection();

        foreach ($results as $key => $value) {
            $collection->add(new MenuItem([
                'id' => $value['id'],
                'parent_id' => $value['parent_id'],
                'title' => $value['title'],
                'slug' => $value['slug'],
                'caption' => $value['caption'],
                'menu_type' => $value['menu_type'],
                'item_type' => 'app',
                'position' => $value['position']
            ]));
        }

        return $collection;
    }
}
