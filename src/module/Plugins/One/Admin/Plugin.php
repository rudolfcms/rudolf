<?php

namespace Rudolf\Modules\Plugins\One\Admin;

class Plugin
{
    /**
     * @var array
     */
    private $module;

    /**
     * @param array $data
     */
    public function setData(array $data)
    {
        $this->module = $data;
    }

    public function id()
    {
        return $this->module['id'];
    }

    public function name()
    {
        return $this->module['name'];
    }

    public function status()
    {
        return $this->module['status'];
    }

    public function editUrl()
    {
        return DIR.'/admin/plugins/edit/'.$this->name();
    }

    public function offUrl()
    {
        return DIR.'/admin/plugins/switch/'.$this->name();
    }

    public function onUrl()
    {
        return DIR.'/admin/plugins/switch/'.$this->name();
    }
}
