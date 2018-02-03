<?php

namespace Rudolf\Component\Modules;

use Rudolf\Component\Routing\RouteCollection;

class Manager
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var Module[]
     */
    private $modules;

    /**
     * Constructor.
     * Run modules manager service
     *
     * @param string $path Absolute path to modules directory
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($path)
    {
        $this->path = $path;

        $this->modules = $this->getCollection()->getActive();
    }

    /**
     * @return Collection
     * @throws \InvalidArgumentException
     */
    public function getCollection()
    {
        /** @var array $modules */
        $modules = include CONFIG_ROOT.'/modules.php';

        $collection = new Collection();

        foreach ($modules as $key => $value) {
            $collection->add($key, new Module($key, $value));
        }

        return $collection;
    }

    /**
     * Add modules routes to Rudolf RouteCollection.
     *
     * @param RouteCollection $collection
     */
    public function addRoutes(RouteCollection $collection)
    {
        (new Routing($this->modules, $collection, $this->path))->addRoutes();
    }

    public function addHooks()
    {
        (new Hooks($this->modules, $this->path))->addHooks();
    }
}
