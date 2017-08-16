<?php

namespace Rudolf\Modules\Pages\One\Admin;

use Rudolf\Framework\Model\AdminModel;

class AddModel extends AdminModel
{
    /**
     * Add article.
     *
     * @param array $f
     *
     * @return int Article ID
     */
    public function add($f)
    {
        $userInfo = self::$auth->getUser();

        $f['added'] = date('Y-m-d H:i:s');
        $f['adder'] = $userInfo['id'];

        $stmt = $this->pdo->prepare("
            INSERT INTO {$this->prefix}pages
                (title
                , keywords
                , description
                , content
                , added
                , adder_ID
                , slug
                , published
                , parent_id)
            VALUES
                (:title
                , :keywords
                , :description
                , :content
                , :added
                , :adder
                , :slug
                , :published
                , :parent_id)
        ");
        $stmt->bindValue(':title', $f['title'], \PDO::PARAM_STR);
        $stmt->bindValue(':keywords', $f['keywords'], \PDO::PARAM_STR);
        $stmt->bindValue(':description', $f['description'], \PDO::PARAM_STR);
        $stmt->bindValue(':content', $f['content'], \PDO::PARAM_STR);
        $stmt->bindValue(':added', $f['added'], \PDO::PARAM_STR);
        $stmt->bindValue(':adder', $f['adder'], \PDO::PARAM_INT);
        $stmt->bindValue(':slug', $f['slug'], \PDO::PARAM_STR);
        $stmt->bindValue(':published', $f['published'], \PDO::PARAM_INT);
        $stmt->bindValue(':parent_id', $f['parent_id'], \PDO::PARAM_INT);

        if (!$stmt->execute()) {
            return false;
        }

        return $this->pdo->lastInsertId();
    }
}
