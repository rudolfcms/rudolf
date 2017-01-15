<?php

namespace Rudolf\Modules\Galleries\One\Admin;

use Rudolf\Framework\View\AdminView;
use Rudolf\Modules\Categories\CategoryAddon;

class EditView extends AdminView
{
    use CategoryAddon;

    /**
     * Set data to edit gallery.
     *
     * @param array $gallery
     */
    public function editGallery($gallery)
    {
        $this->gallery = new Gallery($gallery);

        $this->pageTitle = _('Edit gallery');
        $this->head->setTitle($this->pageTitle);

        $this->path = $this->gallery->editUrl();

        $this->templateType = 'edit';

        $this->template = 'gallery-one';
    }
}
