<?php

namespace Rudolf\Component\Modules;

class Hooks
{
    /**
     * @var array
     */
    private $modules;

    public function __construct(array $modules, $path = '/modules')
    {
        $this->modules = $modules;
        $this->path = $path;
    }

    public function addHooks()
    {
        foreach ($this->modules as $key => $value) {
            $file = $this->path.'/'.$value->getName().'/hooks.php';

            if (is_file($file)) {
                include $file;
            }
        }
    }
}
