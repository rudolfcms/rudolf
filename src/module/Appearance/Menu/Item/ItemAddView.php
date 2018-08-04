<?php

namespace Rudolf\Modules\Appearance\Menu\Item;

use Rudolf\Component\Helpers\Navigation\MenuItemCollection;
use Rudolf\Framework\View\AdminView;

class ItemAddView extends AdminView
{
    /**
     * @var MenuItem
     */
    protected $item;

    /**
     * @var array
     */
    protected $types;

    /**
     * @var MenuItemCollection
     */
    protected $items;

    public function display($data, $types, $items)
    {
        $this->pageTitle = _('Menu editor');
        $this->head->setTitle($this->pageTitle);
        $this->item = $data;
        $this->types = $types;
        $this->items = $items;

        $this->templateType = 'add';

        $this->template = 'appearance-menu-item';
    }
}
