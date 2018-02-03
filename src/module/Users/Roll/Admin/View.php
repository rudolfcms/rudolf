<?php

namespace Rudolf\Modules\Users\Roll\Admin;

use Rudolf\Component\Helpers\Pagination\Calc as Pagination;
use Rudolf\Component\Helpers\Pagination\Loop;
use Rudolf\Framework\View\AdminView;
use Rudolf\Modules\Users\One\Admin\User;

class View extends AdminView
{
    /**
     * @var Loop
     */
    protected $loop;

    /**
     * @param array $data
     * @param Pagination $pagination
     */
    public function setData(array $data, Pagination $pagination)
    {
        $this->loop = new Loop(
            $data,
            $pagination,
            User::class,
            '/admin/users/list'
        );

        $this->pageTitle = _('Users list');

        $this->head->setTitle($this->pageTitle);

        $this->template = 'users-list';
    }
}
