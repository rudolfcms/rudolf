<?php

namespace Rudolf\Component\Modules;

class Module
{
    private $name;
    private $status;

    public function __construct($name, $status = 1)
    {
        $this->name = $name;
        $this->status = $status;

        if (empty($name)) {
            throw new \InvalidArgumentException('Invalid module name');
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
        $file = CONFIG_ROOT.'/modules/'.strtolower($this->name).'.php';

        if (!file_exists($file)) {
            throw new \Exception("{$this->name} module configuration does not exist");
        }

        return include $file;
    }
}
