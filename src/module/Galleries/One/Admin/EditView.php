<?php

namespace Rudolf\Modules\Galleries\One\Admin;

use Rudolf\Framework\View\AdminView;
use Rudolf\Modules\Categories\CategoryAddon;

class EditView extends AdminView
{
    use CategoryAddon;

    /**
     * @var Gallery
     */
    protected $gallery;

    /**
     * @var string
     */
    protected $path;

    /**
     * Set data to edit gallery.
     *
     * @param array $gallery
     */
    public function editGallery(array $gallery)
    {
        $this->gallery = new Gallery($gallery);

        $this->pageTitle = _('Edit gallery');
        $this->head->setTitle($this->pageTitle);

        $this->path = $this->gallery->editUrl();

        $this->templateType = 'edit';

        $this->template = 'gallery-one';
    }
}
