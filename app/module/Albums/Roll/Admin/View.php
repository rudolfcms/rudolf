<?php
namespace Rudolf\Modules\Albums\Roll\Admin;

use Rudolf\Component\Helpers\Pagination\Calc as Pagination;
use Rudolf\Component\Helpers\Pagination\Loop;
use Rudolf\Framework\View\AdminView;

class View extends AdminView
{

    public function setData($data, Pagination $pagination)
    {
        $this->loop = new Loop(
            $data,
            $pagination,
            'Rudolf\\Modules\\Albums\\One\\Admin\\AAlbum',
            '/admin/albums/list'
        );

        $this->head->setTitle($this->pageTitle());

        $this->template = 'albums-list';
    }
    
    protected function pageTitle()
    {
        return _('Albums list');
    }
}
