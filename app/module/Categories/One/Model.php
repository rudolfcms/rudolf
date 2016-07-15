<?php
namespace Rudolf\Modules\Categories\One;

use Rudolf\Component\Libs\Pagination;
use Rudolf\Framework\Model\FrontModel;

class Model extends FrontModel {

    /**
     * Get category info
     * 
     * @param string $slug
     * 
     * @return array
     */
    public function getCategoryInfo($slug, $type)
    {
        $stmt = $this->pdo->prepare("
            SELECT *
            FROM {$this->prefix}categories
            WHERE slug = :slug
              AND TYPE = :type
        ");
        $stmt->bindValue(':slug', $slug, \PDO::PARAM_INT);
        $stmt->bindValue(':type', $type, \PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if (empty($results[0])) {
            return false;
        }

        return $results[0];
    }

     /**
     * Get category info
     * 
     * @param string $slug
     * 
     * @return array
     */
    public function getCategoryInfoById($id)
    {
        $stmt = $this->pdo->prepare("
            SELECT category.id,
                   category.title,
                   category.keywords,
                   category.description,
                   category.content,
                   category.added,
                   category.modified,
                   category.adder_ID,
                   category.modifier_ID,
                   category.views,
                   category.slug,
                   adder.nick AS adder_nick,
                   adder.first_name AS adder_first_name,
                   adder.surname AS adder_surname,
                   adder.email AS adder_email,
                   modifier.nick AS adder_nick,
                   modifier.first_name AS modifier_first_name,
                   modifier.surname AS modifier_surname,
                   modifier.email AS modifier_email
            FROM {$this->prefix}categories AS category

            LEFT JOIN {$this->prefix}users AS adder ON category.adder_ID = adder.id

            LEFT JOIN {$this->prefix}users AS modifier ON category.modifier_ID = modifier.id
            WHERE category.id = :id
        ");
        $stmt->bindValue(':id', $id, \PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if (empty($results[0])) {
            return false;
        }

        return $results[0];
    }
}
