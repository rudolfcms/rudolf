<?php

namespace Rudolf\Component\Helpers\Navigation;

class MenuItemCollection
{
	private $collection;

	public function add(MenuItem $item)
	{
		if (null == $item->getId()) {
			$item->setId(count($this->collection) +1);
		}

		$this->collection[] = $item;

		return $item->getId();
	}

	public function getAll()
	{
		return $this->collection;
	}

	/**
	 * Get menu items by type
	 *
	 * @param string $type
	 *
	 * @return array of MenuItem
	 */
	public function getByType($type)
	{
		$items = [];

		foreach ($this->collection as $key => $item) {
            if ($type === $item->getType()) {
                $items[] = $item;
            }
        }

        usort($items, function($a, $b) {
		    return strcmp($a->getPosition(), $b->getPosition());
		});

        return $items;
	}
}
