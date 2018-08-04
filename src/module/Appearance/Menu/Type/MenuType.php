<?php

namespace Rudolf\Modules\Appearance\Menu\Type;

use Rudolf\Component\Helpers\Navigation\MenuItem as Item;
use Rudolf\Component\Html\Text;

class MenuType extends Item
{
    public function isPublished()
    {
        return true;
    }

    public function delUrl()
    {
        return DIR.'/admin/appearance/menu/del-type/'.$this->getId();
    }

    public function date()
    {
        return 'xxxx-xx-xx';
    }

    public function getTitle()
    {
        return $this->data['title'];
    }

    public function title()
    {
        return $this->getTitle();
    }

    public function getDescription()
    {
        return $this->data['description'];
    }

    public function getSlug()
    {
        return Text::escape($this->data['menu_type']);
    }
}
