<?php

namespace Rudolf\Modules\Pages\One\Admin;

use Rudolf\Framework\Model\AdminModel;

class EditModel extends AdminModel
{
    /**
     * Update article by id.
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
                {$this->prefix}pages
            SET
                parent_ID = :parent_id,
                title = :title,
                keywords = :keywords,
                description = :description,
                content = :content,
                modified = :modified,
                modifier_ID = :modifier,
                slug = :slug,
                published = :published
            WHERE
                id = :id
        ");
        $stmt->bindValue(':parent_id', $f['parent_id'], \PDO::PARAM_INT);
        $stmt->bindValue(':title', $f['title'], \PDO::PARAM_STR);
        $stmt->bindValue(':keywords', $f['keywords'], \PDO::PARAM_STR);
        $stmt->bindValue(':description', $f['description'], \PDO::PARAM_STR);
        $stmt->bindValue(':content', $f['content'], \PDO::PARAM_STR);
        $stmt->bindValue(':modified', $f['modified'], \PDO::PARAM_STR);
        $stmt->bindValue(':modifier', $f['modifier'], \PDO::PARAM_INT);
        $stmt->bindValue(':slug', $f['slug'], \PDO::PARAM_STR);
        $stmt->bindValue(':published', $f['published'], \PDO::PARAM_INT);
        $stmt->bindValue(':id', $f['id'], \PDO::PARAM_INT);

        return $status = $stmt->execute();
    }
}
