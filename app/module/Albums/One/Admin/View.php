<?php
namespace Rudolf\Modules\Albums\One\Admin;

use Rudolf\Html\Text;
use Rudolf\Modules\A_admin\AdminView;
use Rudolf\Modules\Categories\CategoryAddon;

class View extends AdminView
{
    use CategoryAddon;

    /**
     * Set data to edit album
     * 
     * @param array $album
     * 
     * @return void
     */
    public function editAlbum($album)
    {
        $this->album = new AAlbum($album);

        $this->pageTitle = _('Edit album');
        $this->head->setTitle($this->pageTitle());

        $this->path = $this->album->editUrl();

        $this->templateType = 'edit';

        $this->template = 'albums-one';
    }

    /**
     * Set data to delete album
     * 
     * @param array $album
     * 
     * @return void
     */
    public function delAlbum($album)
    {
        $this->album = new AAlbum($album);

        $this->pageTitle = _('Delete album');
        $this->head->setTitle($this->pageTitle());

        $this->path = $this->album->delUrl();

        $this->templateType = 'del';

        $this->template = 'albums-del';
    }

    /**
     * Set data do add album
     * 
     * @param array $album
     * 
     * @return void
     */
    public function addAlbum($album)
    {
        $this->album = new AAlbum($album);

        $this->pageTitle = _('Add album');
        $this->head->setTitle($this->pageTitle());

        $this->path = DIR . '/admin/albums/add';

        $this->templateType = 'add';

        $this->template = 'albums-one';
    }
}
