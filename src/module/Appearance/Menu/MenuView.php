<?php

namespace Rudolf\Modules\Appearance\Menu;

use Rudolf\Component\Helpers\Navigation\MenuItemCollection;
use Rudolf\Framework\View\AdminView;

class MenuView extends AdminView
{
    private $items;

    protected $types;

    public function display(MenuItemCollection $items, $types)
    {
        $this->pageTitle = _('Menu editor');
        $this->head->setTitle($this->pageTitle);
        $this->items = $items;
        $this->types = $types;

        $this->template = 'appearance-menu-editor';
    }

    public function createMenu($type)
    {
        $nav = new Navigation();
        $nav->setType($type);
        $nav->setItems($this->items);
        return $nav->create();
    }
}
