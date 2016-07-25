<?php

namespace Rudolf\Component\Helpers\Navigation;

class MenuItem
{
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function setId($id)
    {
        $this->data['id'] = $id;
    }

    public function getId()
    {
        return isset($this->data['id']) ? $this->data['id'] : null;
    }

    public function getParentId()
    {
        return $this->data['parent_id'];
    }

    public function getTitle()
    {
        return $this->data['title'];
    }

    public function getSlug()
    {
        $slug = $this->data['slug'];

        switch ($this->data['item_type']) {
            case 'absolute':
                // $newItems[$key];
                break;
            case 'app':
            default:
                $slug = DIR.'/'.$slug;
                break;
        }

        return $slug;
    }

    public function getCaption()
    {
        return $this->data['caption'];
    }

    public function getType()
    {
        return $this->data['menu_type'];
    }

    public function getPosition()
    {
        return $this->data['position'];
    }

    public function getIco()
    {
        return isset($this->data['ico']) ? $this->data['ico'] : null;
    }
}
