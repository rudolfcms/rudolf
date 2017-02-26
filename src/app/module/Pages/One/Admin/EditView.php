<?php

namespace Rudolf\Modules\Pages\One\Admin;

use Rudolf\Framework\View\AdminView;

class EditView extends AdminView
{
    use PagesAddon;

    /**
     * Set data to edit page.
     * 
     * @param array $page
     */
    public function editPage($page)
    {
        $this->page = new Page($page);

        $this->pageTitle = _('Edit page');
        $this->head->setTitle($this->pageTitle);

        $this->path = $this->page->editUrl();

        $this->templateType = 'edit';

        $this->template = 'pages-one';
    }
}
