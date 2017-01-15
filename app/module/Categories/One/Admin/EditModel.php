<?php

namespace Rudolf\Modules\Categories\One\Admin;

use Rudolf\Framework\Model\AdminModel;

class EditModel extends AdminModel
{
    /**
     * Update category by id.
     * 
     * @param array $data
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
                {$this->prefix}categories
            SET
                title = :title,
                keywords = :keywords,
                description = :description,
                content = :content,
                modified = :modified,
                modifier_ID = :modifier,
                slug = :slug
            WHERE
                id = :id
        ");
        $stmt->bindValue(':title', $f['title'], \PDO::PARAM_STR);
        $stmt->bindValue(':keywords', $f['keywords'], \PDO::PARAM_STR);
        $stmt->bindValue(':description', $f['description'], \PDO::PARAM_STR);
        $stmt->bindValue(':content', $f['content'], \PDO::PARAM_STR);
        $stmt->bindValue(':modified', $f['modified'], \PDO::PARAM_STR);
        $stmt->bindValue(':modifier', $f['modifier'], \PDO::PARAM_INT);
        $stmt->bindValue(':slug', $f['slug'], \PDO::PARAM_STR);
        $stmt->bindValue(':id', $f['id'], \PDO::PARAM_INT);

        return $status = $stmt->execute();
    }
}
