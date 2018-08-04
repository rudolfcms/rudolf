<?php

namespace Rudolf\Component\Helpers\Navigation;

class MenuItemCollection
{
    /**
     * @var MenuItem[]
     */
    private $collection = [];

    /**
     * @param MenuItem $item
     * @return int|null
     */
    public function add(MenuItem $item)
    {
        if (null === $item->getId()) {
            $item->setId(count($this->collection) + 1);
        }

        $this->collection[] = $item;

        return $item->getId();
    }

    /**
     * @return MenuItem[]
     */
    public function getAll()
    {
        return $this->collection;
    }

    /**
     * Get menu items by type.
     *
     * @param string $type
     *
     * @return MenuItem[]
     */
    public function getByType($type, $sort = true)
    {
        if (empty($this->collection)) {
            return [];
        }
        $items = [];

        foreach ($this->collection as $key => $item) {
            if ($type === $item->getType()) {
                $items[] = $item;
            }
        }

        if (true === $sort) {
            usort($items, [$this, 'sort']);
        }

        return $items;
    }

    /**
     * @param MenuItem $a
     * @param MenuItem $b
     * @return int
     */
    private function sort($a, $b)
    {
        return strcmp($a->getPosition(), $b->getPosition());
    }
}
