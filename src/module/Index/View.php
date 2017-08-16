<?php

namespace Rudolf\Modules\Index;

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
    public function setData(array $data, Pagination $pagination)
    {
        $this->loop = new Loop(
            $data,
            $pagination,
            'Rudolf\\Modules\\Articles\\One\\Article'
        );

        $tags = new TagsGenerator($pagination, $this->head);
        $tags->create();

        $page = $pagination->getPageNumber();
        $allPages = $pagination->getAllPages();
        $pageInfo = null;

        if (1 !== $page) {
            $this->head->setTitle(sprintf(_('Page %1$s of %2$s'), $page, $allPages));
            $pageInfo = 'page/'.$page;
        }

        $this->head->setCanonical(DIR.'/'.$pageInfo);

        $this->template = 'index';
    }
}
