<?php
namespace Rudolf\Modules\Categories\Roll\Admin;

use Rudolf\Component\Helpers\Pagination\Calc as Pagination;
use Rudolf\Component\Helpers\Pagination\Loop;
use Rudolf\Modules\A_admin\AdminView;

class View extends AdminView
{
    public function setData($data, Pagination $pagination)
    {
        $this->loop = new Loop($data, $pagination,
            'Rudolf\\Modules\\Categories\\One\\Admin\Category',
            '/admin/categories/list'
        );

        $this->head->setTitle($this->pageTitle());

        $this->template = 'categories-list';
    }
    
    protected function pageTitle()
    {
        return _('Categories list');
    }
}
