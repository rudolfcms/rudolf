<?php

namespace Rudolf\Modules\Pages\One;

use Rudolf\Framework\Model\FrontModel;

class Model extends FrontModel
{
    /**
     * Returns page id by path.
     * 
     * @param array $path
     * @param array $pages
     * 
     * @return int|bool
     */
    public function getPageIdByPath(array $path, $pages = false)
    {
        if (false === $pages) {
            $pages = $this->getPagesList();
        }

        for ($pid = 0, $i = 0; $i < count($path); ++$i) {
            $pidInArray = isset($pages[$path[$i]][$pid]) ? $pages[$path[$i]][$pid] : false;

            if (false === $pidInArray) {
                return false;
            }

            if (isset($pidInArray['parent_id']) && $pid == $pidInArray['parent_id']) {
                $pid = $pidInArray['id'];
            } else {
                return false;
            }
        }

        return $pid;
    }

    /**
     * Returns page data.
     * 
     * @param int $id
     * 
     * @return array
     */
    public function getOneById($id)
    {
        $stmt = $this->pdo->prepare("
            SELECT page.id, page.parent_id, page.title, page.content, page.keywords, page.views,
                   page.description, page.published, page.slug, page.added, page.modified,
                   adder.nick AS adder_nick,
                   adder.first_name AS adder_first_name,
                   adder.surname AS adder_surname,
                   modifier.nick AS adder_nick,
                   modifier.first_name AS modifier_first_name,
                   modifier.surname AS modifier_surname
            FROM {$this->prefix}pages as page
            LEFT JOIN {$this->prefix}users AS adder ON page.adder_ID = adder.id
            LEFT JOIN {$this->prefix}users AS modifier ON page.modifier_ID = modifier.id
            WHERE page.id = :id
        ");
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll();
        $stmt->closeCursor();

        if (empty($results)) {
            return false;
        }

        return $results[0];
    }
}
