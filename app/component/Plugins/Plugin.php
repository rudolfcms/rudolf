<?php

namespace Rudolf\Component\Plugins;

class Plugin
{
    private $name;
    private $status;

    public function __construct($name, $status = 1)
    {
        $this->name = $name;
        $this->status = $status;

        if (empty($name)) {
            throw new \InvalidArgumentException('Invalid plugin name');
        }
    }

    public function getName()
    {
        return $this->name;
    }

    public function getStatus()
    {
        return (bool) $this->status;
    }

    public function getConfig()
    {
        $file = CONFIG_ROOT.'/plugins/'.strtolower($this->name).'.php';

        if (!file_exists($file)) {
            throw new \Exception("{$this->name} plugin configuration does not exist");
        }

        return include $file;
    }
}
