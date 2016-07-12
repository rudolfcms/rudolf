<?php
namespace Rudolf\Modules\Pages;

use Rudolf\Modules\A_front\FView;
use Rudolf\Component\Html\Breadcrumbs;

class View extends FView
{
    use Traits;

    public function page($data)
    {
        $this->page = $data;
        
        $this->head->setTitle($this->title());

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
