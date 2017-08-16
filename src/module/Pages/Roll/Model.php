<?php

namespace Rudolf\Modules\Pages\Roll;

use Rudolf\Framework\Model\FrontModel;

class Model extends FrontModel
{
    /**
     * Returns pages list.
     *
     * @return array|bool
     */
    public function getPagesList()
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

        return $results;
    }
}
