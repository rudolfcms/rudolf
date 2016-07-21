<?php

namespace Rudolf\Modules\Users\Login;

use Rudolf\Component\Http\Response;
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
            $response = new Response('');
            $response->setHeader(['Location', DIR.'/admin']);
            $response->send();
            exit;
        }

        $view = new View();
        $view->form($_POST, $status);
        $view->render('admin');
    }

    /**
     * logout.
     */
    public function logout()
    {
        $model = new Model();
        $model->logout();

        $response = new Response('');
        $response->setHeader(['Location', DIR.'/user/login']);
        $response->send();
        exit;
    }
}
