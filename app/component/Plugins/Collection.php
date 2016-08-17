<?php

namespace Rudolf\Component\Plugins;

class Collection
{
    /**
     * @var array
     */
    private $collection;

    /**
     * Add plugin to collection.
     *
     * @param string $name   Plugin name
     * @param Plugin $plugin Plugin object
     */
    public function add($name, Plugin $plugin)
    {
        $this->collection[$name] = $plugin;
    }

    /**
     * Get all plugins.
     */
    public function getAll()
    {
        return $this->collection;
    }

    /**
     * Get active plugins.
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
