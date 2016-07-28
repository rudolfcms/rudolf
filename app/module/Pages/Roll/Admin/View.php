<?php

namespace Rudolf\Modules\Pages\Roll\Admin;

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
            'Rudolf\\Modules\\Pages\\One\\Admin\\Page',
            '/admin/pages/list'
        );

        $this->pageTitle = _('Pages list');

        $this->head->setTitle($this->pageTitle);

        $this->template = 'pages-list';
    }
}
