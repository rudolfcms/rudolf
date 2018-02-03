<?php

namespace Rudolf\Modules\Albums\Roll\Admin;

use Rudolf\Component\Helpers\Pagination\Calc as Pagination;
use Rudolf\Component\Helpers\Pagination\Loop;
use Rudolf\Framework\View\AdminView;
use Rudolf\Modules\Albums\One\Admin\Album;

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
            Album::class,
            '/admin/albums/list'
        );

        $this->pageTitle = _('Albums list');
        $this->head->setTitle($this->pageTitle);

        $this->template = 'albums-list';
    }
}
