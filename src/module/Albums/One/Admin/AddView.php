<?php

namespace Rudolf\Modules\Albums\One\Admin;

use Rudolf\Framework\View\AdminView;
use Rudolf\Modules\Categories\CategoryAddon;

class AddView extends AdminView
{
    use CategoryAddon;

    /**
     * @var Album
     */
    protected $album;

    /**
     * @var string
     */
    protected $path;

    /**
     * Set data do add album.
     *
     * @param array $album
     */
    public function addAlbum(array $album)
    {
        $this->album = new Album($album);

        $this->pageTitle = _('Add album');
        $this->head->setTitle($this->pageTitle);

        $this->path = DIR.'/admin/albums/add';

        $this->templateType = 'add';

        $this->template = 'albums-one';
    }
}
