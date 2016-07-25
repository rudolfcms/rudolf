<?php

namespace Rudolf\Framework\View;

use Rudolf\Component\Helpers\Navigation\MenuItemCollection;
use Rudolf\Component\Html\Navigation;

abstract class FrontView extends BaseView
{
    private static $menuItemsCollection;
    protected static $request;

    public static function setFrontData(MenuItemCollection $collection, $request)
    {
        self::$menuItemsCollection = $collection;
        self::$request = $request;
    }

    public function pageNav($type, $classes, $nesting = 0, $before = [], $after = [])
    {
        $nav = new Navigation();
        $nav->setType($type);
        $nav->setItems(self::$menuItemsCollection);
        $nav->setCurrent(self::$request);
        $nav->setClasses($classes);
        $nav->setNesting($nesting);
        $nav->setBefore($before);
        $nav->setAfter($after);

        return $nav->create();
    }
}
