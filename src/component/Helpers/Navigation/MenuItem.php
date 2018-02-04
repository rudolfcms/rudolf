<?php

namespace Rudolf\Component\Helpers\Navigation;

use Rudolf\Component\Html\Text;

class MenuItem
{
    /**
     * @var array
     */
    protected $data;

    /**
     * MenuItem constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->data['id'] = $id;
    }

    /**
     * @return int|null
     */
    public function getId()
    {
        return isset($this->data['id']) ? (int) $this->data['id'] : null;
    }

    /**
     * @return int
     */
    public function getParentId()
    {
        return (int) $this->data['parent_id'];
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return Text::escape($this->data['title']);
    }

    /**
     * @return string
     */
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

        return Text::escape($slug);
    }

    /**
     * @return string
     */
    public function getCaption()
    {
        return Text::escape($this->data['caption']);
    }

    /**
     * @return string
     */
    public function getType()
    {
        return Text::escape($this->data['menu_type']);
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return (int) $this->data['position'];
    }

    /**
     * @return string|null
     */
    public function getIco()
    {
        return isset($this->data['ico']) ? Text::escape($this->data['ico']) : null;
    }
}
