<?php

namespace Rudolf\Modules\Pages\One;

use Rudolf\Component\Html\Breadcrumbs;
use Rudolf\Framework\View\FrontView;

class View extends FrontView
{
    /**
     * @var Page
     */
    protected $page;

    /**
     * @var array
     */
    protected $pagesList;

    /**
     * @var array
     */
    protected $aAddress;

    /**
     * @param array $data
     */
    public function page(array $data)
    {
        $this->page = new Page($data);

        $this->head->setTitle($this->page->title());
        $this->head->setCanonical($this->page->url());

        $this->template = 'page';
    }

    /**
     * @param array $list
     * @param array $aAddress
     */
    public function setBreadcrumbsData(array $list, array $aAddress)
    {
        $this->pagesList = $list;
        $this->aAddress = $aAddress;
    }

    /**
     * @param int $nesting
     * @param array $classes
     *
     * @return bool|string
     */
    public function breadcrumb($nesting = 0, $classes = [])
    {
        $breadcrumbs = new Breadcrumbs();
        $breadcrumbs->setElements($this->pagesList);
        $breadcrumbs->setAddress($this->aAddress);
        $breadcrumbs->setClasses($classes);
        $breadcrumbs->setNesting($nesting);

        return $breadcrumbs->create();
    }
}
