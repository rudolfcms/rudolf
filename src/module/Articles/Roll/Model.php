<?php

namespace Rudolf\Modules\Articles\Roll;

use Rudolf\Modules\Articles;

class Model extends Articles\Model
{
    /**
     * @var array|string
     */
    private $where;

    /**
     * Returns array with articles list.
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
     * Returns total number of articles items.
     *
     * @param array|string $where
     *
     * @return int
     */
    public function getTotalNumber($where = ['published' => 1])
    {
        $this->where = $where;

        return $this->countItems('articles', $where);
    }
}
