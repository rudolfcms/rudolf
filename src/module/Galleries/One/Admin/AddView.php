<?php

namespace Rudolf\Modules\Galleries\One\Admin;

use Rudolf\Framework\View\AdminView;

class AddView extends AdminView
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
     * @var string
     */
    protected $templateType;

    /**
     * Set data to add gallery.
     *
     * @param array $gallery
     */
    public function addGallery(array $gallery)
    {
        $this->gallery = new Gallery($gallery);

        $this->pageTitle = _('Add gallery');
        $this->head->setTitle($this->pageTitle);

        $this->path = DIR.'/admin/galleries/add';

        $this->templateType = 'add';

        $this->template = 'gallery-one';
    }
}
