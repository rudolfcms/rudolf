<?php

namespace Rudolf\Modules\Albums\Roll;

use Rudolf\Modules\Albums;

class Model extends Albums\Model
{
    /**
     * @var string
     */
    private $where;

    /**
     * Returns array with albums list.
     *
     * @param int   $limit
     * @param int   $onPage
     * @param array $orderBy
     *
     * @return array|bool
     */
    public function getList($limit = 0, $onPage = 10, $orderBy = ['id', 'desc'])
    {
        $clause = $this->createWhereClausule($this->where);

        $stmt = $this->pdo->prepare($this->queryPart('full').
            "WHERE $clause ORDER BY $orderBy[0] $orderBy[1] LIMIT $limit, $onPage");

        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        if (!empty($results)) {
            return $results;
        }

        return false;
    }

    /**
     * Returns total number of albums items.
     *
     * @param array|string $where
     *
     * @return int
     */
    public function getTotalNumber($where = ['published' => 1])
    {
        $this->where = $where;

        return $this->countItems('albums', $where);
    }
}
