<?php

namespace Rudolf\Modules\Users\Roll\Admin;

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
            'Rudolf\\Modules\\Users\\One\\Admin\\User',
            '/admin/users/list'
        );

        $this->pageTitle = _('Users list');

        $this->head->setTitle($this->pageTitle);

        $this->template = 'users-list';
    }
}
