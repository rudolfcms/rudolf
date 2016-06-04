<?php
namespace Rudolf\Modules\Koxy\One;

use Rudolf\Modules\A_front\FController;

class Controller extends FController
{
    public function vote($type)
    {
        $model = new Model();
        $view = new View();

        $response = $model->vote($type, $_POST);

        $view->data = $response;
        $view->render('', 'json');
    }
}