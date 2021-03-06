<?php

namespace Rudolf\Modules\Tools\Admin\One\DatabaseDump;

use Rudolf\Framework\View\AdminView;

class View extends AdminView
{
    /**
     * @param array $data
     */
    public function setData(array $data)
    {
        $this->data = $data;
        $this->pageTitle = _('Database dump');
        $this->head->setTitle($this->pageTitle);

        $this->template = 'tool-dbdump';
    }
}
