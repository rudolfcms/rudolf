<?php

namespace Rudolf\Modules\Categories\Roll\Admin;

use Rudolf\Modules\Categories\Roll;

class Model extends Roll\Model
{
    public function getList($limit = 0, $onPage = 10, $orderBy = ['id', 'desc'])
    {
        $clausule = $this->createWhereClausule($this->where);

        $type = $this->where['type'];
        $stmt = $this->pdo->prepare("
            SELECT category.id,
                   category.title,
                   category.slug,
                   COUNT(items.id) AS total
            FROM {$this->prefix}categories AS category
            LEFT JOIN {$this->prefix}$type AS items ON category.id=items.category_ID
            WHERE category.type = '$type'
            GROUP BY category.id
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

    public function getAll($type)
    {
        $stmt = $this->pdo->prepare("
            SELECT category.id,
                   category.title,
                   category.slug,
                   COUNT(items.id) AS total
            FROM {$this->prefix}categories AS category
            LEFT JOIN {$this->prefix}$type AS items ON category.id=items.category_ID
            WHERE category.type = '$type'
            GROUP BY category.id
        ");

        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        if (!empty($results)) {
            return $results;
        }

        return false;
    }
}
