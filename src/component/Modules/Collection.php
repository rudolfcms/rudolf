<?php

namespace Rudolf\Component\Modules;

class Collection
{
    /**
     * @var Module[]
     */
    private $collection;

    /**
     * Add module to collection.
     *
     * @param string $name   Module name
     * @param Module $module Module object
     */
    public function add($name, Module $module)
    {
        $this->collection[$name] = $module;
    }

    /**
     * Get all modules.
     *
     * @return Module[]
     */
    public function getAll()
    {
        return $this->collection;
    }

    /**
     * Get active modules.
     *
     * @return bool|Module[]
     */
    public function getActive()
    {
        if (empty($this->collection)) {
            return false;
        }

        foreach ($this->collection as $key => $value) {
            if ($value->getStatus()) {
                $collection[] = $value;
            }
        }

        if (empty($collection)) {
            return false;
        }

        return $collection;
    }
}
