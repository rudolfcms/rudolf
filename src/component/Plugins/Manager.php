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
     * @var Plugin[]
     */
    private $plugins;

    /**
     * Constructor.
     * Run plugins manager service
     *
     * @param string $path Absolute path to plugins directory
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($path)
    {
        $this->path = $path;

        $this->plugins = $this->getCollection()->getActive();
    }

    /**
     * @return Collection
     * @throws \InvalidArgumentException
     */
    public function getCollection()
    {
        /** @var array $plugins */
        $plugins = include CONFIG_ROOT.'/plugins.php';

        $collection = new Collection();

        foreach ($plugins as $key => $value) {
            $collection->add($key, new Plugin($key, $value));
        }

        return $collection;
    }

    public function addRoutes(RouteCollection $collection)
    {
        if (empty($this->plugins)) {
            return;
        }

        (new Routing($this->plugins, $collection, $this->path))->addRoutes();
    }

    public function addHooks()
    {
        if (empty($this->plugins)) {
            return;
        }

        (new Hooks($this->plugins, $this->path))->addHooks();
    }
}
