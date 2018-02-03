<?php

namespace Rudolf\Modules\Pages\Roll\Admin;

use Rudolf\Framework\Model\AdminModel;

class Model extends AdminModel
{
    /**
     * @var string
     */
    private $where;

    /**
     * Returns array with pages list.
     *
     * @param int   $limit
     * @param int   $onPage
     * @param array $orderBy
     *
     * @return array|bool
     */
    public function getList($limit = 0, $onPage = 10, array $orderBy = ['id', 'desc'])
    {
        $clausule = $this->createWhereClausule($this->where);

        $stmt = $this->pdo->query("
            SELECT *
            FROM {$this->prefix}pages
            WHERE $clausule
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
     * Returns total number of pages items.
     *
     * @param array|string $where
     *
     * @return int
     */
    public function getTotalNumber(array $where = ['published' => 1])
    {
        $this->where = $where;

        return $this->countItems('pages', $where);
    }
}
