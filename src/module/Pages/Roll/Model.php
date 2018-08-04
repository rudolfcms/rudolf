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
    public function getPagesList()
    {
        $stmt = $this->pdo->query("
            SELECT id,
                   parent_id,
                   slug,
                   title,
                   published
            FROM {$this->prefix}pages
        ");
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        if (empty($results)) {
            return [];
        }

        return $results;
    }
}
