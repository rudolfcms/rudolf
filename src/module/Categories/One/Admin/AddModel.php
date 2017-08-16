<?php

namespace Rudolf\Modules\Categories\One\Admin;

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
            INSERT INTO {$this->prefix}categories
                (title
                , keywords
                , description
                , content
                , added
                , adder_ID
                , slug
                , type)
            VALUES
                (:title
                , :keywords
                , :description
                , :content
                , :added
                , :adder
                , :slug
                , :type)
        ");
        $stmt->bindValue(':title', $f['title'], \PDO::PARAM_STR);
        $stmt->bindValue(':keywords', $f['keywords'], \PDO::PARAM_STR);
        $stmt->bindValue(':description', $f['description'], \PDO::PARAM_STR);
        $stmt->bindValue(':content', $f['content'], \PDO::PARAM_STR);
        $stmt->bindValue(':added', $f['added'], \PDO::PARAM_STR);
        $stmt->bindValue(':adder', $f['adder'], \PDO::PARAM_INT);
        $stmt->bindValue(':slug', $f['slug'], \PDO::PARAM_STR);
        $stmt->bindValue(':type', $f['type'], \PDO::PARAM_STR);

        if (!$stmt->execute()) {
            return false;
        }

        return $this->pdo->lastInsertId();
    }
}
