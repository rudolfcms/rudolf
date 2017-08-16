<?php

namespace Rudolf\Component\Modules;

class Module
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $status;

    /**
     * Module constructor.
     *
     * @param $name
     * @param int $status
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($name, $status = 1)
    {
        $this->name = $name;
        $this->status = $status;

        if (empty($name)) {
            throw new \InvalidArgumentException('Invalid module name');
        }
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function getStatus()
    {
        return (bool) $this->status;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getConfig()
    {
        $file = CONFIG_ROOT.'/modules/'.strtolower($this->name).'.php';

        if (!file_exists($file)) {
            throw new \Exception("{$this->name} module configuration does not exist");
        }

        return include $file;
    }
}
