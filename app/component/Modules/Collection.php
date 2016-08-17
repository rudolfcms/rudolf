<?php

namespace Rudolf\Component\Modules;

class Collection
{
    /**
     * @var array
     */
    private $collection;

    /**
     * Add module to collection.
     *
     * @param string $name Module name
     * @param Module $module Module object
     */
    public function add($name, Module $module)
    {
        $this->collection[$name] = $module;

    }

    /**
     * Get all modules.
     */
    public function getAll()
    {
        return $this->collection;
    }

    /**
     * Get active modules.
     */
    public function getActive()
    {
        foreach ($this->collection as $key => $value) {
            if ($value->getStatus()) {
                $collection[] = $value;
            }
        }

        return $collection;
    }
}
