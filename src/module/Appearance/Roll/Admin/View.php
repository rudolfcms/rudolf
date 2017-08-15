<?php

namespace Rudolf\Modules\Appearance\Roll\Admin;

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
            'Rudolf\\Modules\\Appearance\\One\\Admin\\Theme',
            '/admin/appearance/list'
        );

        $this->pageTitle = _('Themes list');
        $this->head->setTitle($this->pageTitle);

        $this->template = 'appearance-themes-list';
    }
}
