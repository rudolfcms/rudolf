<?php

namespace Rudolf\Modules\Albums\One\Admin;

use Rudolf\Framework\Model\AdminModel;

class AddModel extends AdminModel
{
    /**
     * Add article.
     *
     * @param array $f
     *
     * @return int|bool
     */
    public function add($f)
    {
        $userInfo = self::$auth->getUser();
        $f['added'] = date('Y-m-d H:i:s');
        $f['adder'] = $userInfo['id'];

        $stmt = $this->pdo->prepare("
            INSERT INTO {$this->prefix}albums
                (title
                , author
                , date
                , added
                , adder_ID
                , slug
                , album
                , thumb
                , photos
                , published
                , category_ID)
            VALUES
                (:title
                , :author
                , :date
                , :added
                , :adder
                , :slug
                , :album
                , :thumb
                , :photos
                , :published
                , :category_ID)
        ");
        $stmt->bindValue(':title', $f['title'], \PDO::PARAM_STR);
        $stmt->bindValue(':author', $f['author'], \PDO::PARAM_STR);
        $stmt->bindValue(':date', $f['date'], \PDO::PARAM_STR);
        $stmt->bindValue(':added', $f['added'], \PDO::PARAM_STR);
        $stmt->bindValue(':adder', $f['adder'], \PDO::PARAM_INT);
        $stmt->bindValue(':slug', $f['slug'], \PDO::PARAM_STR);
        $stmt->bindValue(':album', $f['album'], \PDO::PARAM_STR);
        $stmt->bindValue(':thumb', $f['thumb'], \PDO::PARAM_STR);
        $stmt->bindValue(':photos', $f['photos'], \PDO::PARAM_INT);
        $stmt->bindValue(':published', $f['published'], \PDO::PARAM_INT);
        $stmt->bindValue(':category_ID', $f['category_ID'], \PDO::PARAM_INT);

        if (!$stmt->execute()) {
            return false;
        }

        return $this->pdo->lastInsertId();
    }
}
