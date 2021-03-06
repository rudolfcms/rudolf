<?php

namespace Rudolf\Component\Plugins;

class Hooks
{
    /**
     * @var array
     */
    private $plugins;

    /**
     * @var string
     */
    private $path;

    /**
     * Hooks constructor.
     *
     * @param array $plugins
     * @param $path
     */
    public function __construct(array $plugins, $path)
    {
        $this->plugins = $plugins;
        $this->path = $path;
    }

    public function addHooks()
    {
        foreach ($this->plugins as $key => $value) {
            $file = $this->path.'/'.$value->getName().'/hooks.php';

            if (is_file($file)) {
                include $file;
            }
        }
    }
}
