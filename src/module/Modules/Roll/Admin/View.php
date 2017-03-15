<?php

namespace Rudolf\Modules\Modules\Roll\Admin;

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
            'Rudolf\\Modules\\Modules\\One\\Admin\\Module',
            '/admin/modules/list'
        );

        $this->pageTitle = _('Modules list');
        $this->head->setTitle($this->pageTitle);

        $this->template = 'modules-list';
    }
}
