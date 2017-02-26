<?php

namespace Rudolf\Modules\Galleries\One\Admin;

use Rudolf\Framework\Model\AdminModel;
use Rudolf\Component\Modules\Module;

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
                {$this->prefix}galleries
            SET
                title = :title,
                modified = :modified,
                modifier_ID = :modifier,
                slug = :slug,
                thumb_width = :thumb_width,
                thumb_height = :thumb_height
            WHERE
                id = :id
        ");
        $stmt->bindValue(':title', $f['title'], \PDO::PARAM_STR);
        $stmt->bindValue(':modified', $f['modified'], \PDO::PARAM_STR);
        $stmt->bindValue(':modifier', $f['modifier'], \PDO::PARAM_INT);
        $stmt->bindValue(':slug', $f['slug'], \PDO::PARAM_STR);
        $stmt->bindValue(':thumb_width', $f['thumb_width'], \PDO::PARAM_INT);
        $stmt->bindValue(':thumb_height', $f['thumb_height'], \PDO::PARAM_INT);
        $stmt->bindValue(':id', $f['id'], \PDO::PARAM_INT);

        return $status = $stmt->execute();
    }

    public function delete($post)
    {
        $config = (new Module('galleries'))->getConfig();
        $file = $config['path_root'].'/'.$post['slug'].'/'.$post['delete'];

        if (file_exists($file)) {
            unlink($file);
        }
    }

    public function upload($file, $post)
    {
        $config = (new Module('galleries'))->getConfig();

        $uploadDir = $config['path_root'].'/'.$post['slug'].'/';
        $uploadfile = $uploadDir.basename($file['name']);

        return move_uploaded_file($file['tmp_name'], $uploadfile);
    }
}
