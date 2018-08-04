<?php

namespace Rudolf\Modules\Appearance\Menu\Item;

use Rudolf\Framework\View\AdminView;

class ItemEditView extends AdminView
{
    protected $item;
    protected $types;
    protected $items;

    public function display($data, $types, $items)
    {
        $this->pageTitle = _('Menu editor');
        $this->head->setTitle($this->pageTitle);
        $this->item  = $data;
        $this->types = $types;
        $this->items = $items;

        $this->templateType = 'edit';

        $this->template = 'appearance-menu-item';
    }
}
