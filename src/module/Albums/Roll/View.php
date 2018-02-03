<?php

namespace Rudolf\Modules\Albums\Roll;

use Rudolf\Component\Helpers\Pagination\Calc;
use Rudolf\Component\Helpers\Pagination\Loop;
use Rudolf\Component\Helpers\Pagination\TagsGenerator;
use Rudolf\Component\Modules\Module;
use Rudolf\Framework\View\FrontView;
use Rudolf\Modules\Albums\One\Album;

class View extends FrontView
{
    /**
     * @var Loop
     */
    protected $loop;

    /**
     * @param array $data
     * @param Calc  $pagination
     *
     * @throws \Exception
     */
    public function rollView(array $data, Calc $pagination)
    {
        $config = (new Module('albums'))->getConfig();
        $path = '/'.$config['path'];

        $this->loop = new Loop(
            $data,
            $pagination,
            Album::class,
            $path
        );

        $tags = new TagsGenerator($pagination, $this->head);
        $tags->setPath($path);
        $tags->create();

        $page = $pagination->getPageNumber();
        $allPages = $pagination->getAllPages();

        $this->pageTitle = _('Albums');

        $titleBefore = null;

        $canonical = $path;

        if (1 !== $page) {
            $titleBefore = sprintf(_('Page %1$s of %2$s'), $page, $allPages).' &ndash; ';
            $canonical .= '/page/'.$page;
        }

        $this->head->setTitle($titleBefore.$this->pageTitle);
        $this->head->setCanonical($canonical);

        $this->template = 'albums';
    }

    public function pageTitle()
    {
        return $this->pageTitle;
    }
}
