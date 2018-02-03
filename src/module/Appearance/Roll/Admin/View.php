<?php

namespace Rudolf\Modules\Appearance\Roll\Admin;

use Rudolf\Component\Helpers\Pagination\Calc as Pagination;
use Rudolf\Component\Helpers\Pagination\Loop;
use Rudolf\Framework\View\AdminView;
use Rudolf\Modules\Appearance\One\Admin\Theme;

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
            Theme::class,
            '/admin/appearance/list'
        );

        $this->pageTitle = _('Themes list');
        $this->head->setTitle($this->pageTitle);

        $this->template = 'appearance-themes-list';
    }
}
