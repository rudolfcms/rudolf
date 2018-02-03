<?php

namespace Rudolf\Modules\Categories\Roll;

use Rudolf\Framework\Model\FrontModel;

class Model extends FrontModel
{
    /**
     * @var string|array
     */
    protected $where;

    /**
     * Returns array with categories list.
     *
     * @param int   $limit
     * @param int   $onPage
     * @param array $orderBy
     *
     * @return array|bool
     */
    public function getList($limit = 0, $onPage = 10, array $orderBy = ['id', 'desc'])
    {
        $clause = $this->createWhereClausule($this->where);

        $stmt = $this->pdo->query("
            SELECT *
            FROM {$this->prefix}categories
            WHERE $clause
            ORDER BY $orderBy[0] $orderBy[1] LIMIT $limit,
                                                   $onPage
        ");
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
