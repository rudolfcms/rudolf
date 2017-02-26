<?php

namespace Rudolf\Modules\Modules\One\Admin;

class Module
{
    public function setData($data)
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
        return DIR.'/admin/modules/edit/'.$this->name();
    }

    public function offUrl()
    {
        return DIR.'/admin/modules/switch/'.$this->name();
    }

    public function onUrl()
    {
        return DIR.'/admin/modules/switch/'.$this->name();
    }
}
