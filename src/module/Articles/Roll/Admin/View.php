<?php

namespace Rudolf\Modules\Articles\Roll\Admin;

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
            'Rudolf\\Modules\\Articles\\One\\Admin\\Article',
            '/admin/articles/list'
        );

        $this->pageTitle = _('Articles list');

        $this->head->setTitle($this->pageTitle);

        $this->template = 'articles-list';
    }
}
