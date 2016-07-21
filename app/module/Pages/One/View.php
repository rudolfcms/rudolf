<?php

namespace Rudolf\Modules\Pages\One;

use Rudolf\Component\Html\Breadcrumbs;
use Rudolf\Framework\View\FrontView;

class View extends FrontView
{
    public function page($data)
    {
        $this->page = new Page($data);

        $this->head->setTitle($this->page->title());

        $this->template = 'page';
    }

    public function setBreadcrumbsData($list, $aAddress)
    {
        $this->pagesList = $list;
        $this->aAddress = $aAddress;
    }

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
