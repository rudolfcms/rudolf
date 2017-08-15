<?php

namespace Rudolf\Modules\Albums\One\Admin;

use Rudolf\Framework\Model\AdminModel;

class EditModel extends AdminModel
{
    /**
     * Update article by id.
     *
     * @param array $f
     *
     * @return int
     */
    public function update($f)
    {
        $userInfo = self::$auth->getUser();
        $f['modified'] = date('Y-m-d H:i:s');
        $f['modifier'] = $userInfo['id'];

        $stmt = $this->pdo->prepare("
            UPDATE
                {$this->prefix}albums
            SET
                title = :title,
                author = :author,
                date = :date,
                modified = :modified,
                modifier_ID = :modifier,
                slug = :slug,
                album = :album,
                thumb = :thumb,
                photos = :photos,
                published = :published,
                category_ID = :category_ID
            WHERE
                id = :id
        ");

        $stmt->bindValue(':title', $f['title'], \PDO::PARAM_STR);
        $stmt->bindValue(':author', $f['author'], \PDO::PARAM_STR);
        $stmt->bindValue(':date', $f['date'], \PDO::PARAM_STR);
        $stmt->bindValue(':modified', $f['modified'], \PDO::PARAM_STR);
        $stmt->bindValue(':modifier', $f['modifier'], \PDO::PARAM_INT);
        $stmt->bindValue(':slug', $f['slug'], \PDO::PARAM_STR);
        $stmt->bindValue(':album', $f['album'], \PDO::PARAM_STR);
        $stmt->bindValue(':thumb', $f['thumb'], \PDO::PARAM_STR);
        $stmt->bindValue(':photos', $f['photos'], \PDO::PARAM_INT);
        $stmt->bindValue(':published', $f['published'], \PDO::PARAM_INT);
        $stmt->bindValue(':id', $f['id'], \PDO::PARAM_INT);
        $stmt->bindValue(':category_ID', $f['category_ID'], \PDO::PARAM_INT);

        return $stmt->execute();
    }
}
