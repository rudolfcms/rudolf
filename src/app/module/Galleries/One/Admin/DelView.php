<?php

namespace Rudolf\Modules\Galleries\One\Admin;

use Rudolf\Framework\View\AdminView;

class DelView extends AdminView
{
    /**
     * Set data to delete gallery.
     *
     * @param array $gallery
     */
    public function delGallery($gallery)
    {
        $this->gallery = new Gallery($gallery);

        $this->pageTitle = _('Delete gallery');
        $this->head->setTitle($this->pageTitle);

        $this->path = $this->gallery->delUrl();

        $this->template = 'gallery-del';
    }
}
