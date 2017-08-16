<?php

namespace Rudolf\Modules\Albums\Category\Roll\Admin;

use Rudolf\Component\Helpers\Pagination\Calc as Pagination;
use Rudolf\Component\Helpers\Pagination\Loop;
use Rudolf\Framework\View\AdminView;

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
            'Rudolf\\Modules\\Albums\\Category\\One\\Admin\\Category',
            '/admin/articles\\categories/list'
        );

        $this->head->setTitle($this->pageTitle());

        $this->template = 'categories-list';
    }

    /**
     * @return string
     */
    protected function pageTitle()
    {
        return _('Category list');
    }
}
