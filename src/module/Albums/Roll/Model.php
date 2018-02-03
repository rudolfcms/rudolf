<?php

namespace Rudolf\Modules\Albums\Roll;

use Rudolf\Modules\Albums;

class Model extends Albums\Model
{
    /**
     * @var array|string
     */
    private $where;

    /**
     * Returns array with albums list.
     *
     * @param int   $limit
     * @param int   $onPage
     * @param array $orderBy
     *
     * @return array
     */
    public function getList($limit = 0, $onPage = 10, array $orderBy = ['id', 'desc'])
    {
        $clause = $this->createWhereClausule($this->where);

        $stmt = $this->pdo->query($this->queryPart('full').
            "WHERE $clause ORDER BY $orderBy[0] $orderBy[1] LIMIT $limit, $onPage");
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        return $results;
    }

    /**
     * Returns total number of albums items.
     *
     * @param array|string $where
     *
     * @return int
     */
    public function getTotalNumber(array $where = ['published' => 1])
    {
        $this->where = $where;

        return $this->countItems('albums', $where);
    }
}
