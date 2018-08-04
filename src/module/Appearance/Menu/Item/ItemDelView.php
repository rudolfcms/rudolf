<?php

namespace Rudolf\Modules\Appearance\Menu\Item;

use Rudolf\Framework\View\AdminView;

class ItemDelView extends AdminView
{
    protected $item;
    protected $path;

    public function display($data)
    {
        $this->pageTitle = _('Menu editor');
        $this->head->setTitle($this->pageTitle);
        $this->item = $data;

        $this->path = '';

        $this->template = 'menu-del';
    }
}
