<?php

namespace Rudolf\Modules\Articles\Roll;

use Rudolf\Component\Helpers\Pagination\Calc as Pagination;
use Rudolf\Component\Helpers\Pagination\Loop;
use Rudolf\Component\Helpers\Pagination\TagsGenerator;
use Rudolf\Framework\View\FrontView;

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
    public function rollView(array $data, Pagination $pagination)
    {
        $this->loop = new Loop(
            $data,
            $pagination,
            'Rudolf\\Modules\\Articles\\One\\Article'
        );

        $tags = new TagsGenerator($pagination, $this->head);
        $tags->create();

        $this->template = 'index';
    }
}
