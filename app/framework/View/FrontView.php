<?php

namespace Rudolf\Framework\View;

use Rudolf\Component\Html\Navigation;

abstract class FrontView extends BaseView
{
    protected $frontData;

    public function setFrontData($menu, $current = 0)
    {
        $this->frontData = [$menu, $current];
    }

    public function pageNav($type, $classes, $nesting = 0, $before = [], $after = [])
    {
        $nav = new Navigation();
        $nav->setType($type);
        $nav->setItems($this->frontData[0]['menu_items']);
        $nav->setCurrent($this->frontData[1]);
        $nav->setClasses($classes);
        $nav->setNesting($nesting);
        $nav->setBefore($before);
        $nav->setAfter($after);

        return $nav->create();
    }
}
