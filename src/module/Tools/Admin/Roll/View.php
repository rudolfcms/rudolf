<?php

namespace Rudolf\Modules\Tools\Admin\Roll;

use Rudolf\Component\Helpers\Pagination\Calc as Pagination;
use Rudolf\Component\Helpers\Pagination\Loop;
use Rudolf\Framework\View\AdminView;
use Rudolf\Modules\Tools\Admin\One\Tool;

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
            Tool::class,
            '/admin/plugins/list'
        );

        $this->pageTitle = _('Tools list');
        $this->head->setTitle($this->pageTitle);

        $this->template = 'tools-list';
    }
}
