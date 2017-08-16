<?php

namespace Rudolf\Framework\View;

use Rudolf\Component\Helpers\Navigation\MenuItemCollection;
use Rudolf\Component\Html\Navigation;

abstract class FrontView extends BaseView
{
    /**
     * @var MenuItemCollection
     */
    private static $menuItemsCollection;

    /**
     * @var string
     */
    protected static $request;

    public function init()
    {
        $this->domPlugins->front();
    }

    /**
     * @param MenuItemCollection $collection
     * @param string $request
     */
    public static function setFrontData(MenuItemCollection $collection, $request)
    {
        self::$menuItemsCollection = $collection;
        self::$request = $request;
    }

    /**
     * @param string $type
     * @param array $classes
     * @param int $nesting
     * @param array $before
     * @param array $after
     *
     * @return bool|string
     */
    public function pageNav($type = 'main', $classes = [], $nesting = 0, $before = [], $after = [])
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
