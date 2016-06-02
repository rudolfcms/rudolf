<?php
namespace Rudolf\Modules\Articles\Roll;

use Rudolf\Modules\A_front\FView;

class View extends FView
{

    public function rollView($data, $pagination)
    {
        $this->roll = new Roll($data, $pagination);

        $this->template = 'index';
    }
}
