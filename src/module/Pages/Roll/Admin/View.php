<?php

namespace Rudolf\Modules\Pages\Roll\Admin;

use Rudolf\Component\Helpers\Pagination\Calc as Pagination;
use Rudolf\Component\Helpers\Pagination\Loop;
use Rudolf\Framework\View\AdminView;
use Rudolf\Modules\Pages\One\Admin\Page;

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
            Page::class,
            '/admin/pages/list'
        );

        $this->pageTitle = _('Pages list');

        $this->head->setTitle($this->pageTitle);

        $this->template = 'pages-list';
    }
}
