<?php

namespace Rudolf\Modules\Galleries\One\Admin;

use Rudolf\Framework\Model\AdminModel;
use Rudolf\Component\Modules\Module;
use Rudolf\Modules\Galleries\One;

class DelModel extends AdminModel
{
    /**
     * Delete gallery.
     *
     * @param int $id gallery ID
     */
    public function delete($id)
    {
        $query = $this->pdo->prepare("DELETE FROM {$this->prefix}galleries WHERE id = :id");
        $query->bindValue(':id', $id, \PDO::PARAM_INT);

        $f = (new One\Model())->getGalleryInfoById($id);
        $config = (new Module('galleries'))->getConfig();
        $directory = $config['path_root'].'/'.$f['slug'];
        array_map('unlink', glob($directory.'/*'));
        rmdir($directory);

        return $query->execute();
    }
}
