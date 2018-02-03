<?php

namespace Rudolf\Modules\Galleries\Roll;

use Rudolf\Modules\Galleries\Model as AbstractModel;

class Model extends AbstractModel
{
    /**
     * @var string
     */
    protected $where;

    /**
     * Returns total number of galleries items.
     *
     * @param array|string $where
     *
     * @return int
     */
    public function getTotalNumber(array $where = ['published' => 1])
    {
        $this->where = $where;

        return $this->countItems('galleries', $where);
    }

    /**
     * Returns array with galleries list.
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
}
