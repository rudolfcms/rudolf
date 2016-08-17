<?php

namespace Rudolf\Component\Plugins;

use Rudolf\Component\Routing\RouteCollection;

class Routing
{
    private $collection;
    private $plugins;

    /**
     * Constructor.
     * 
     * @param array $plugins
     * @param RouteCollection
     * @param string $path from-root path to plugins directory
     */
    public function __construct(array $plugins, RouteCollection $collection, $path = '/plugins')
    {
        $this->collection = $collection;
        $this->plugins = $plugins;
        $this->path = $path;
    }

    /**
     * Add routes to collection.
     * 
     * @return RouteCollection
     */
    public function addRoutes()
    {
        $collection = $this->collection;

        foreach ($this->plugins as $key => $value) {
            $file = $this->path.'/'.$value->getName().'/routing.php';

            if (is_file($file)) {
                include $file;
            }
        }

        return $collection;
    }
}
