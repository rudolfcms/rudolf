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
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->prefix}categories WHERE slug = :slug and type = :type");
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
        $stmt = $this->pdo->prepare("SELECT category.id, category.title, category.keywords,
            category.description, category.content,
            category.added, category.modified, category.adder_ID, category.modifier_ID, category.views,
            category.slug, 

            adder.nick as adder_nick, adder.first_name as adder_first_name,
            adder.surname as adder_surname, adder.email as adder_email,

            modifier.nick as adder_nick, modifier.first_name as modifier_first_name,
            modifier.surname as modifier_surname, modifier.email as modifier_email

            FROM {$this->prefix}categories as category

            -- join on adder_ID
            LEFT JOIN {$this->prefix}users as adder ON category.adder_ID = adder.id

            -- join on modifier_ID
            LEFT JOIN {$this->prefix}users as modifier ON category.modifier_ID = modifier.id

            WHERE category.id = :id");
        $stmt->bindValue(':id', $id, \PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if (empty($results[0])) {
            return false;
        }

        return $results[0];
    }
}
