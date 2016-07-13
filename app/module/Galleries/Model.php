<?php
namespace Rudolf\Modules\Galleries;

use Rudolf\Framework\Model\FrontModel;

class Model extends FrontModel
{
    /**
     * It get gallery info by id
     *
     * @param int $id
     *
     * @return array
     */
    public function getGalleryInfoById($id)
    {
        $id = (int) $id;
        $stmt = $this->pdo->prepare("SELECT id, title, url, thumb_width, thumb_height
            FROM {$this->prefix}galleries WHERE id = :id");
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        if (empty($results)) {
            return false;
        }

        return $results[0];
    }

    public function getNumberOfAll($where)
    {
        return $this->count('galleries', $where);
    }
}
