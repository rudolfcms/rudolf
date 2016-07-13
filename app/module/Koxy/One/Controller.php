<?php
namespace Rudolf\Modules\Koxy\One;

use Rudolf\Framework\Controller\FrontController;

class Controller extends FrontController
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