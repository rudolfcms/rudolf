<?php

namespace Rudolf\Modules\Plugins\Roll\Admin;

use Rudolf\Component\Helpers\Pagination\Calc as Pagination;
use Rudolf\Component\Helpers\Pagination\Loop;
use Rudolf\Framework\View\AdminView;

class View extends AdminView
{
    public function setData($data, Pagination $pagination)
    {
        $this->loop = new Loop(
            $data,
            $pagination,
            'Rudolf\\Modules\\Plugins\\One\\Admin\\Plugin',
            '/admin/plugins/list'
        );

        $this->pageTitle = _('Plugins list');
        $this->head->setTitle($this->pageTitle);

        $this->template = 'modules-list';
    }
}
