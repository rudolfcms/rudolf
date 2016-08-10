<?php

namespace Rudolf\Modules\Galleries\Roll;

use Rudolf\Modules\Galleries\Model as AbstractModel;

class Model extends AbstractModel
{
    /**
     * Returns total number of galleries items.
     * 
     * @param array|string $where
     * 
     * @return int
     */
    public function getTotalNumber($where = ['published' => 1])
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
    public function getList($limit = 0, $onPage = 10, $orderBy = ['id', 'desc'])
    {
        $clausule = $this->createWhereClausule($this->where);

        $stmt = $this->pdo->prepare($this->queryPart('full').
            "WHERE $clausule ORDER BY $orderBy[0] $orderBy[1] LIMIT $limit, $onPage");

        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        if (!empty($results)) {
            return $results;
        }

        return false;
    }
}
