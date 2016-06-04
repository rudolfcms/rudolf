<?php
namespace Rudolf\Modules\Koxy\Roll;

use Rudolf\Component\Helpers\Pagination\Calc as Pagination;
use Rudolf\Component\Helpers\Pagination\Loop;
use Rudolf\Modules\A_front\FView;

class View extends FView
{
    public function setData($data, Pagination $pagination)
    {
        $this->loop = new Loop($data, $pagination,
        	'Rudolf\\Modules\\Koxy\\One\\Kox'
        );

        $this->template = 'koxy';
    }
}
