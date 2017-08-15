<?php

namespace Rudolf\Modules\Pages\One\Admin;

use Rudolf\Framework\View\AdminView;

class AddView extends AdminView
{
    use PagesAddon;

    /**
     * Set data do add page.
     *
     * @param array $page
     */
    public function addPage($page)
    {
        $this->page = new Page($page);

        $this->pageTitle = _('Add page');
        $this->head->setTitle($this->pageTitle);

        $this->path = DIR.'/admin/pages/add';

        $this->templateType = 'add';

        $this->template = 'pages-one';
    }
}
