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
        switch ($this->data['item_type']) {
            case 'absolute':
                // $newItems[$key];
                break;
            case 'app':
            default:
                $this->data['slug'] = DIR.'/'.$this->data['slug'];
                break;
        }

        return $this->data['slug'];
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
}
