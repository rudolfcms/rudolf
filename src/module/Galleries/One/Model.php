<?php

namespace Rudolf\Modules\Galleries\One;

use Rudolf\Framework\Model\FrontModel;

class Model extends FrontModel
{
    /**
     * It get gallery info by id.
     *
     * @param int $id
     *
     * @return array|bool
     */
    public function getGalleryInfoById($id)
    {
        $id = (int) $id;
        $stmt = $this->pdo->prepare("
            SELECT gallery.id,
                   gallery.title,
                   gallery.slug,
                   gallery.thumb_width,
                   gallery.thumb_height,
                   gallery.added,
                   gallery.modified,
                   gallery.adder_ID,
                   gallery.modifier_ID,
                   adder.nick AS adder_nick,
                   adder.first_name AS adder_first_name,
                   adder.surname AS adder_surname,
                   adder.email AS adder_email,
                   modifier.nick AS adder_nick,
                   modifier.first_name AS modifier_first_name,
                   modifier.surname AS modifier_surname,
                   modifier.email AS modifier_email
            FROM {$this->prefix}galleries AS gallery
            LEFT JOIN {$this->prefix}users AS adder ON gallery.adder_ID = adder.id
            LEFT JOIN {$this->prefix}users AS modifier ON gallery.modifier_ID = modifier.id

            WHERE gallery.id = :id
        ");
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
        return $this->countItems('galleries', $where);
    }
}
