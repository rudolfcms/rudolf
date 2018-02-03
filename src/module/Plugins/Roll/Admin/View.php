<?php

namespace Rudolf\Modules\Plugins\Roll\Admin;

use Rudolf\Component\Helpers\Pagination\Calc as Pagination;
use Rudolf\Component\Helpers\Pagination\Loop;
use Rudolf\Framework\View\AdminView;
use Rudolf\Modules\Plugins\One\Admin\Plugin;

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
            Plugin::class,
            '/admin/plugins/list'
        );

        $this->pageTitle = _('Plugins list');
        $this->head->setTitle($this->pageTitle);

        $this->template = 'modules-list';
    }
}
