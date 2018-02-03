<?php

namespace Rudolf\Modules\Koxy\Roll;

use Rudolf\Component\Helpers\Pagination\Calc as Pagination;
use Rudolf\Component\Helpers\Pagination\Loop;
use Rudolf\Framework\View\FrontView;
use Rudolf\Modules\Koxy\One\Kox;

class View extends FrontView
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
            Kox::class
        );

        $this->template = 'koxy';
    }
}
