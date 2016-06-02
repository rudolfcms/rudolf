<?php
namespace Rudolf\Modules\Categories\Roll\Admin;

use Rudolf\Modules\A_admin\AdminView;

class View extends AdminView
{
    public function setData($data, $pagination)
    {
        $this->roll = new ARoll($data, $pagination, '/admin/categories/list');

        $this->head->setTitle($this->pageTitle());

        $this->template = 'categories-list';
    }
    
    protected function pageTitle()
    {
        return _('Categories list');
    }
}
