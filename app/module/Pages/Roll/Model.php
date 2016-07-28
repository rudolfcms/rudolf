<?php

namespace Rudolf\Modules\Pages\Roll;

use Rudolf\Framework\Model\AdminModel;

class Model extends AdminModel
{
    /**
     * Returns pages list.
     * 
     * @return array
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
        $results = $stmt->fetchAll();
        $stmt->closeCursor();

        if (empty($results)) {
            return false;
        }
        $i = 0;

        foreach ($results as $key => $value) {
            $array[$value['slug']][$value['parent_id']] = array(
                'id' => $value['id'],
                'parent_id' => $value['parent_id'],
                'slug' => $value['slug'],
                'title' => $value['title'],
                'published' => $value['published'],
            );
        }

        return $array;
    }

    /**
     * Returns array with pages list.
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
            FROM {$this->prefix}pages
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
     * Returns total number of pages items.
     * 
     * @param array|string $where
     * 
     * @return int
     */
    public function getTotalNumber($where = ['published' => 1])
    {
        $this->where = $where;

        return $this->countItems('pages', $where);
    }
}
