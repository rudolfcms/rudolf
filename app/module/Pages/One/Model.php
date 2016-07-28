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
            $pidInArray = isset($pages[$path[$i]]) ? $pages[$path[$i]][$pid] : false;

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
    public function getPageById($id)
    {
        $stmt = $this->pdo->prepare("
            SELECT *
            FROM {$this->prefix}pages
            WHERE id = :id
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
