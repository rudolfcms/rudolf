<?php

namespace Rudolf\Modules\Appearance\Menu\Type;

use Rudolf\Framework\View\AdminView;

class TypeEditView extends AdminView
{
    /**
     * @var MenuType
     */
    protected $item;

    public function display(MenuType $item)
    {
        $this->pageTitle = _('Menu editor');
        $this->head->setTitle($this->pageTitle);
        $this->item = $item;

        $this->templateType = 'edit';
        $this->template = 'appearance-menu-type';
    }
}
