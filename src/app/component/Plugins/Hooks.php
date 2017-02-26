<?php

namespace Rudolf\Component\Plugins;

class Hooks
{
    /**
     * @var array
     */
    private $plugins;

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
