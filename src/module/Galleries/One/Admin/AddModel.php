<?php

namespace Rudolf\Modules\Galleries\One\Admin;

use Rudolf\Framework\Model\AdminModel;
use Rudolf\Component\Modules\Module;

class AddModel extends AdminModel
{
    /**
     * Add article.
     *
     * @param array $f
     *
     * @return int
     * @throws \Exception
     */
    public function add($f)
    {
        $userInfo = self::$auth->getUser();
        $f['added'] = date('Y-m-d H:i:s');
        $f['adder_ID'] = $userInfo['id'];

        $stmt = $this->pdo->prepare("
            INSERT INTO {$this->prefix}galleries
                (title
                , added
                , adder_ID
                , slug
                , thumb_width
                , thumb_height)
            VALUES
                (:title
                , :added
                , :adder_ID
                , :slug
                , :thumb_width
                , :thumb_height)
        ");
        $stmt->bindValue(':title', $f['title'], \PDO::PARAM_STR);
        $stmt->bindValue(':added', $f['added'], \PDO::PARAM_STR);
        $stmt->bindValue(':adder_ID', $f['adder_ID'], \PDO::PARAM_INT);
        $stmt->bindValue(':slug', $f['slug'], \PDO::PARAM_STR);
        $stmt->bindValue(':thumb_width', $f['thumb_width'] ? $f['thumb_width'] : 209, \PDO::PARAM_INT);
        $stmt->bindValue(':thumb_height', $f['thumb_height'] ? $f['thumb_height'] : 157, \PDO::PARAM_INT);

        if (!$stmt->execute()) {
            return false;
        }

        $id = $this->pdo->lastInsertId();
        $config = (new Module('galleries'))->getConfig();
        $directory = $config['path_root'].'/'.$f['slug'];

        if (file_exists($directory)) {
            $directory = $directory.'-'.$id;
            $stmt = $this->pdo->prepare("UPDATE {$this->prefix}galleries SET slug = :slug WHERE id = :id");
            $stmt->bindValue(':slug', $f['slug'].'-'.$id, \PDO::PARAM_STR);
            $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
            $stmt->execute();
        }

        if (!mkdir($directory) && !is_dir($directory)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $directory));
        }

        return $id;
    }
}
