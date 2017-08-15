<?php

namespace Rudolf\Modules\Pages\One\Admin;

use Rudolf\Framework\View\AdminView;

class DelView extends AdminView
{
    /**
     * Set data to delete page.
     *
     * @param array $page
     */
    public function delPage($page)
    {
        $this->page = new Page($page);

        $this->pageTitle = _('Delete page');
        $this->head->setTitle($this->pageTitle);

        $this->path = $this->page->delUrl();

        $this->templateType = 'del';

        $this->template = 'pages-del';
    }
}
