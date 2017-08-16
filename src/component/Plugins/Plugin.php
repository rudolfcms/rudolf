<?php

namespace Rudolf\Component\Plugins;

class Plugin
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
     * Plugin constructor.
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
            throw new \InvalidArgumentException('Invalid plugin name');
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
     *
     * @throws \Exception
     */
    public function getConfig()
    {
        $file = CONFIG_ROOT.'/plugins/'.strtolower($this->name).'.php';

        if (!file_exists($file)) {
            throw new \Exception("{$this->name} plugin configuration does not exist");
        }

        return include $file;
    }
}
