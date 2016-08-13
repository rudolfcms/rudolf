<?php

namespace Rudolf\Modules\Users\One\Login;

use Rudolf\Framework\Controller\FrontController;

class Controller extends FrontController
{
    /**
     * login.
     * 
     * @param string $redirect
     */
    public function login($redirect)
    {
        $model = new Model();

        $status = null;
        if (isset($_POST['send'])) {
            $status = $model->login($_POST['email'], $_POST['password']);
        }

        if (true === $model->check() || 1 === $status) {
            $this->redirect(DIR.'/admin');
        }

        $view = new View();
        $view->form($_POST, $status);
        $view->render('admin');
    }
}
