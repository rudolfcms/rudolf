<?php

namespace Rudolf\Modules\Users\One\Login;

use Rudolf\Framework\Controller\FrontController;

class Controller extends FrontController
{
    public function login()
    {
        $model = new Model();

        $status = null;
        if (isset($_POST['send'])) {
            /** @var array $_POST */
            $status = $model->login($_POST['email'], $_POST['password']);
        }

        if (1 === $status || true === $model->check()) {
            $this->redirect(DIR.'/admin', 302);
        }

        $view = new View();
        $view->form($_POST, $status);
        $view->render();
    }
}
