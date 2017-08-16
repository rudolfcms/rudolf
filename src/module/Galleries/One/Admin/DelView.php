<?php

namespace Rudolf\Modules\Galleries\One\Admin;

use Rudolf\Framework\View\AdminView;

class DelView extends AdminView
{
    /**
     * @var Gallery
     */
    protected $gallery;

    /**
     * @var string
     */
    protected $path;

    /**
     * Set data to delete gallery.
     *
     * @param array $gallery
     */
    public function delGallery(array $gallery)
    {
        $this->gallery = new Gallery($gallery);

        $this->pageTitle = _('Delete gallery');
        $this->head->setTitle($this->pageTitle);

        $this->path = $this->gallery->delUrl();

        $this->template = 'gallery-del';
    }
}
