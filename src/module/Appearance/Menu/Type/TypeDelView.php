<?php

namespace Rudolf\Modules\Appearance\Menu\Type;

use Rudolf\Framework\View\AdminView;

class TypeDelView extends AdminView
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
