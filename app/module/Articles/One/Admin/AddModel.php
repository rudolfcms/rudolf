<?php

namespace Rudolf\Modules\Articles\One\Admin;

use Rudolf\Framework\Model\AdminModel;

class AddModel extends AdminModel
{
    /**
     * Add article.
     * 
     * @param array $data
     * 
     * @return int Article ID
     */
    public function add($f)
    {
        $userInfo = self::$auth->getUser();

        $f['added'] = date('Y-m-d H:i:s');
        $f['adder'] = $userInfo['id'];

        $stmt = $this->pdo->prepare("
            INSERT INTO {$this->prefix}articles
                (title
                , keywords
                , description
                , content
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
                , :keywords
                , :description
                , :content
                , :author
                , :date
                , :added
                , :adder
                , :slug
                , :album
                , :thumb
                , :photos
                , :published
                , :category_id)
        ");
        $stmt->bindValue(':title', $f['title'], \PDO::PARAM_STR);
        $stmt->bindValue(':keywords', $f['keywords'], \PDO::PARAM_STR);
        $stmt->bindValue(':description', $f['description'], \PDO::PARAM_STR);
        $stmt->bindValue(':content', $f['content'], \PDO::PARAM_STR);
        $stmt->bindValue(':author', $f['author'], \PDO::PARAM_STR);
        $stmt->bindValue(':date', $f['date'], \PDO::PARAM_STR);
        $stmt->bindValue(':added', $f['added'], \PDO::PARAM_STR);
        $stmt->bindValue(':adder', $f['adder'], \PDO::PARAM_INT);
        $stmt->bindValue(':slug', $f['slug'], \PDO::PARAM_STR);
        $stmt->bindValue(':album', $f['album'], \PDO::PARAM_STR);
        $stmt->bindValue(':thumb', $f['thumb'], \PDO::PARAM_STR);
        $stmt->bindValue(':photos', $f['photos'], \PDO::PARAM_INT);
        $stmt->bindValue(':published', $f['published'], \PDO::PARAM_INT);
        $stmt->bindValue(':category_id', $f['category_id'], \PDO::PARAM_INT);

        if (!$stmt->execute()) {
            return false;
        }

        return $this->pdo->lastInsertId();
    }
}
