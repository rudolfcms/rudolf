<?php

namespace Rudolf\Framework\Controller;

use Rudolf\Framework\Model\FrontModel;
use Rudolf\Framework\View\FrontView;

abstract class FrontController extends BaseController
{
    public function init()
    {
        $model = new FrontModel();
        FrontView::setFrontData($model->getMenuItems(), $this->request);
    }
}
