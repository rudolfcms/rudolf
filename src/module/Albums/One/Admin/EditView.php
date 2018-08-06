<?php

namespace Rudolf\Modules\Albums\One\Admin;

use Rudolf\Framework\View\AdminView;
use Rudolf\Modules\Categories\CategoryAddon;

class EditView extends AdminView
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
     * Set data to edit album.
     *
     * @param array $album
     */
    public function editAlbum(array $album)
    {
        $this->album = new Album($album);

        $this->pageTitle = _('Edit album');
        $this->head->setTitle($this->pageTitle);

        $this->path = $this->album->editUrl();

        $this->templateType = 'edit';

        $this->template = 'albums-one';
    }
}
