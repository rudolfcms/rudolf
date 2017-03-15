<?php

namespace Rudolf\Modules\Galleries\Roll\Admin;

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
            'Rudolf\\Modules\\Galleries\\One\\Admin\\Gallery',
            '/admin/galleries/list'
        );

        $this->pageTitle = _('Galleries list');
        $this->head->setTitle($this->pageTitle);

        $this->template = 'galleries-list';
    }
}
