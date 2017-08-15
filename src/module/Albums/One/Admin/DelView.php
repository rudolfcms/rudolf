<?php

namespace Rudolf\Modules\Albums\One\Admin;

use Rudolf\Framework\View\AdminView;
use Rudolf\Modules\Categories\CategoryAddon;

class DelView extends AdminView
{
    use CategoryAddon;

    /**
     * Set data to delete album.
     *
     * @param array $album
     */
    public function delAlbum($album)
    {
        $this->album = new Album($album);

        $this->pageTitle = _('Delete album');
        $this->head->setTitle($this->pageTitle);

        $this->path = $this->album->delUrl();

        $this->templateType = 'del';

        $this->template = 'albums-del';
    }
}
