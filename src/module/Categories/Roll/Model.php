<?php

namespace Rudolf\Modules\Categories\Roll;

use Rudolf\Framework\Model\FrontModel;

class Model extends FrontModel
{
    /**
     * Returns array with categories list.
     *
     * @param int   $limit
     * @param int   $onPage
     * @param array $orderBy
     *
     * @return array
     */
    public function getList($limit = 0, $onPage = 10, $orderBy = ['id', 'desc'])
    {
        $clausule = $this->createWhereClausule($this->where);

        $stmt = $this->pdo->prepare("
            SELECT *
            FROM {$this->prefix}categories
            WHERE $clausule
            ORDER BY $orderBy[0] $orderBy[1] LIMIT $limit,
                                                   $onPage
        ");

        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        if (!empty($results)) {
            return $results;
        }

        return false;
    }

    /**
     * Returns total number of items.
     *
     * @param array|string $where
     *
     * @return int
     */
    public function getTotalNumber($where)
    {
        $this->where = $where;

        return $this->countItems('categories', $where);
    }
}
