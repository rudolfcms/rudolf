<?php

namespace Rudolf\Modules\Pages\One\Admin;

use Rudolf\Framework\View\AdminView;

class DelView extends AdminView
{
    /**
     * @var Page
     */
    protected $page;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var string
     */
    protected $templateType;
    /**
     * Set data to delete page.
     *
     * @param array $page
     */
    public function delPage(array $page)
    {
        $this->page = new Page($page);

        $this->pageTitle = _('Delete page');
        $this->head->setTitle($this->pageTitle);

        $this->path = $this->page->delUrl();

        $this->templateType = 'del';

        $this->template = 'pages-del';
    }
}
