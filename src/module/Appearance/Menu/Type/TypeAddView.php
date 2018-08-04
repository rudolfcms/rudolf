<?php

namespace Rudolf\Modules\Appearance\Menu\Type;

use Rudolf\Framework\View\AdminView;

class TypeAddView extends AdminView
{
    /**
     * @var MenuType
     */
    protected $item;

    public function display(MenuType $item) {
        $this->pageTitle = _('Menu editor');
        $this->head->setTitle($this->pageTitle);
        $this->item = $item;

        $this->templateType = 'add';
        $this->template = 'appearance-menu-type';
    }
}
