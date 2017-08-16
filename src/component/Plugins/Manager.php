<?php

namespace Rudolf\Component\Plugins;

use Rudolf\Component\Routing\RouteCollection;

class Manager
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var array
     */
    private $plugins;

    /**
     * Constructor.
     *
     * Run plugins manager service
     *
     * @param string $path Absolute path to plugins directory
     */
    public function __construct($path)
    {
        $this->path = $path;

        $this->plugins = $this->getCollection()->getActive();
    }

    public function getCollection()
    {
        $plugins = include CONFIG_ROOT.'/plugins.php';

        $collection = new Collection();

        foreach ($plugins as $key => $value) {
            $collection->add($key, new Plugin($key, $value));
        }

        return $collection;
    }

    public function addRoutes(RouteCollection $collection)
    {
        if (!$this->plugins) {
            return;
        }
        (new Routing($this->plugins, $collection, $this->path))->addRoutes();
    }

    public function addHooks()
    {
        if (!$this->plugins) {
            return;
        }

        (new Hooks($this->plugins, $this->path))->addHooks();
    }
}
