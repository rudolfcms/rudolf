<?php

namespace Rudolf\Framework\Controller;

use Rudolf\Framework\Model\FrontModel;

abstract class FrontController extends BaseController
{
    public $frontData;

    public function __construct()
    {
        $model = new FrontModel();

        $this->frontData = [
            'menu_items' => $model->getMenuItems(),
            'menu_types' => $model->getMenuTypes(),
        ];
    }
}
