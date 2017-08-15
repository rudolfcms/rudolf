<?php

namespace Rudolf\Modules\Koxy\Roll;

use Rudolf\Component\Helpers\Pagination\Calc as Pagination;
use Rudolf\Component\Helpers\Pagination\Loop;
use Rudolf\Framework\View\FrontView;

class View extends FrontView
{
    public function setData($data, Pagination $pagination)
    {
        $this->loop = new Loop(
            $data,
            $pagination,
            'Rudolf\\Modules\\Koxy\\One\\Kox'
        );

        $this->template = 'koxy';
    }
}
