<?php

namespace Rudolf\Modules\Pages\Roll;

use Rudolf\Framework\Model\FrontModel;

class Model extends FrontModel
{
    /**
     * Returns pages list.
     * 
     * @return array
     */
    public function getPagesList($simple = false)
    {
        $stmt = $this->pdo->prepare("
            SELECT id,
                   parent_id,
                   slug,
                   title,
                   published
            FROM {$this->prefix}pages
        ");
        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        if (empty($results)) {
            return false;
        }

        if (true === $simple) {
            return $results;
        }
        $i = 0;

        foreach ($results as $key => $value) {
            $array[$value['slug']][$value['parent_id']] = array(
                'id' => $value['id'],
                'parent_id' => $value['parent_id'],
                'slug' => $value['slug'],
                'title' => $value['title'],
                'published' => $value['published'],
            );
        }

        return $array;
    }
}
