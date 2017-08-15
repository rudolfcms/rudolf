<?php

namespace Rudolf\Modules\Albums\Roll;

use Rudolf\Component\Helpers\Pagination\Loop;
use Rudolf\Component\Helpers\Pagination\TagsGenerator;
use Rudolf\Component\Modules\Module;
use Rudolf\Framework\View\FrontView;

class View extends FrontView
{
    public function rollView($data, $pagination)
    {
        $config = (new Module('albums'))->getConfig();
        $path = '/'.$config['path'];

        $this->loop = new Loop(
            $data,
            $pagination,
            'Rudolf\\Modules\\Albums\\One\\Album',
            $path
        );

        $tags = new TagsGenerator($pagination, $this->head);
        $tags->setPath($path);
        $tags->create();

        $page = $pagination->getPageNumber();
        $allPages = $pagination->getAllPages();

        $this->pageTitle = _('Albums');

        $titleBefore = null;

        if (1 !== $page) {
            $titleBefore = sprintf(_('Page %1$s of %2$s'), $page, $allPages).' &ndash; ';
        }

        $this->head->setTitle($titleBefore.$this->pageTitle);

        $this->template = 'albums';
    }

    public function pageTitle()
    {
        return $this->pageTitle;
    }
}
