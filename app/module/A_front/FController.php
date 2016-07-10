<?php
namespace Rudolf\Modules\A_front;

use Rudolf\Framework\Controller\BaseController;

abstract class FController extends BaseController
{
    public $frontData;

    public function __construct()
    {
        $model = new FModel();
        
        $this->frontData = [
            'menu_items' => $model->getMenuItems(),
            'menu_types' => $model->getMenuTypes()
        ];
    }
}
