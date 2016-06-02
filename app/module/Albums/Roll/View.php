<?php
namespace Rudolf\Modules\Albums\Roll;

use Rudolf\Modules\A_front\FView;
use Rudolf\Component\Modules\Module;

class View extends FView
{
    public function rollView($data, $pagination)
    {
        $module = new Module('albums');
        $config = $module->getConfig();

        $this->roll = new Roll($data, $pagination, $config['path']);

        $this->template = 'albums';
    }
}
