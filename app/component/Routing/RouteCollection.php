<?php

namespace Rudolf\Component\Routing;

class RouteCollection
{
    /**
     * @var array
     */
    private $collection;

    /**
     * Adds a route.
     * 
     * @param string $name The route name
     * @param Route  $item A Route instance
     */
    public function add($name, Route $item)
    {
        $this->collection[$name] = $item;
    }

    /**
     * Gets a route by name.
     * 
     * @param string $name The route name
     * 
     * @return Route|null
     */
    public function get($name)
    {
        //!array_key_exists($name, $this->collection)
        if (!isset($this->collection[$name])) {
            return;
        }

        return $this->collection[$name];
    }

    /**
     * Returns all routes in this collection.
     *
     * @return Route array An array of routes collection
     */
    public function getAll()
    {
        if (empty($this->collection)) {
            return false;
        }

        uasort($this->collection, [$this, 'cmp_obj']);

        return $this->collection;
    }

    public static function cmp_obj($a, $b)
    {
        $al = $a->getPriority();
        $bl = $b->getPriority();
        if ($al == $bl) {
            return 0;
        }

        return ($al > $bl) ? +1 : -1;
    }
}
