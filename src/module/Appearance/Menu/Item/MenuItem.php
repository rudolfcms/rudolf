<?php

namespace Rudolf\Modules\Appearance\Menu\Item;

use Rudolf\Component\Helpers\Navigation\MenuItem as Item;
use Rudolf\Component\Html\Text;

class MenuItem extends Item
{
    public function delUrl()
    {
        return DIR.'/admin/appearance/menu/del-item/'.$this->getId();
    }

    public function title()
    {
        return $this->getTitle();
    }
    public function isPublished()
    {
        return true;
    }

    public function date()
    {
        return 'xxxx-xx-xx';
    }

    public function url()
    {
        return Text::escape($this->getSlug());
    }

    public function getItemType()
    {
        return Text::escape($this->data['item_type']);
    }

    public function getRealSlug()
    {
        return Text::escape($this->data['slug']);
    }
}
