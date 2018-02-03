<?php

namespace Rudolf\Modules\Modules\Roll\Admin;

use Rudolf\Component\Helpers\Pagination\Calc as Pagination;
use Rudolf\Component\Helpers\Pagination\Loop;
use Rudolf\Framework\View\AdminView;
use Rudolf\Modules\Modules\One\Admin\Module;

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
            Module::class,
            '/admin/modules/list'
        );

        $this->pageTitle = _('Modules list');
        $this->head->setTitle($this->pageTitle);

        $this->template = 'modules-list';
    }
}
