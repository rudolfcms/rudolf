<?php

namespace Rudolf\Modules\Appearance\Menu;

use Rudolf\Framework\Controller\AdminController;
use Rudolf\Framework\Model\FrontModel;

class MenuController extends AdminController
{
    public function display()
    {
        $view = new MenuView();
        $view->display((new FrontModel())->getMenuItems(), (new MenuModel())->getMenuTypes());
        $view->render();
    }
}
