<?php

namespace Rudolf\Modules\Categories\Roll\Admin;

use Rudolf\Modules\Categories\Roll;

class Model extends Roll\Model
{
    /**
     * @param int $limit
     * @param int $onPage
     * @param array $orderBy
     *
     * @return array
     */
    public function getList($limit = 0, $onPage = 10, array $orderBy = ['id', 'desc'])
    {
        $type = $this->where['type'];
        $stmt = $this->pdo->query("
            SELECT category.id,
                   category.title,
                   category.slug,
                   category.added,
                   category.modified,
                   adder.nick AS adder_nick,
                   adder.first_name AS adder_first_name,
                   adder.surname AS adder_surname,
                   adder.email AS adder_email,
                   modifier.nick AS adder_nick,
                   modifier.first_name AS modifier_first_name,
                   modifier.surname AS modifier_surname,
                   modifier.email AS modifier_email,
                   COUNT(items.id) AS total
            FROM {$this->prefix}categories AS category
            LEFT JOIN {$this->prefix}$type AS items ON category.id=items.category_ID
            LEFT JOIN {$this->prefix}users AS adder ON category.adder_ID = adder.id
            LEFT JOIN {$this->prefix}users AS modifier ON category.modifier_ID = modifier.id
            WHERE category.type = '$type'
            GROUP BY category.id
            ORDER BY $orderBy[0] $orderBy[1] LIMIT $limit,
                                                   $onPage
        ");
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        return $results;
    }

    /**
     * @param string $type
     *
     * @return array
     */
    public function getAll($type)
    {
        $stmt = $this->pdo->query("
            SELECT category.id,
                   category.title,
                   category.slug,
                   COUNT(items.id) AS total
            FROM {$this->prefix}categories AS category
            LEFT JOIN {$this->prefix}$type AS items ON category.id=items.category_ID
            WHERE category.type = '$type'
            GROUP BY category.id
        ");
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        return $results;
    }
}
