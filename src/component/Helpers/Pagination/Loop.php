<?php

namespace Rudolf\Component\Helpers\Pagination;

use Rudolf\Component\Html\Paging;

class Loop
{
    /**
     * @var array
     */
    protected $data;

    /**
     * @var Calc
     */
    protected $calc;

    /**
     * @var string
     */
    protected $itemClassName;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var int
     */
    protected $current = -1;

    /**
     * Constructor.
     *
     * @param array  $data
     * @param ICalc   $calc
     * @param string $itemClassName
     * @param string $path
     */
    public function __construct(
        $data,
        ICalc $calc,
        $itemClassName = 'Rudolf\Component\Helpers\Pagination\Item',
        $path = ''
    ) {
        $this->data = $data;
        $this->calc = $calc;
        $this->itemClassName = $itemClassName;
        $this->path = $path;
    }

    /**
     * Check, is any item to display.
     *
     * @return bool
     */
    public function isItems()
    {
        return is_array($this->data) and !empty($this->data);
    }

    /**
     * Returns number of items to display on page.
     *
     * @return int
     */
    public function total()
    {
        return count($this->data);
    }

    /**
     * Whether there are more items available in the loop.
     *
     * @return bool
     */
    public function haveItems()
    {
        if ($this->current + 1 < $this->total()) {
            return true;
        }

        return false;
    }

    /**
     * Set the current item.
     *
     * @return IItem
     */
    public function item()
    {
        $this->current += 1;
        /**
         * @var IItem $item
         */
        $item = new $this->itemClassName();
        $item->setData($this->data[$this->current]);

        return $item;
    }

    /**
     * Checks if pagination is needed.
     *
     * @return bool
     */
    public function isPagination()
    {
        return 1 < $this->calc->getAllPages();
    }

    /**
     * Get current page number.
     *
     * @return int
     */
    public function getPage()
    {
        return $this->calc->getPageNumber();
    }

    /**
     * Return navigation.
     *
     * @param array $classes
     *                         ul
     *                         current
     * @param int   $nesting
     *
     * @return string
     */
    public function nav($classes, $nesting = 2)
    {
        $nav = new Paging();
        $nav->setInfo($this->calc->nav());
        $nav->setPath($this->path);
        $nav->setClasses($classes);
        $nav->setNesting($nesting);

        return $nav->create();
    }
}
