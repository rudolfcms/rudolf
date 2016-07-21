<?php

namespace Rudolf\Modules\Users\Login;

use Rudolf\Component\Auth\Auth;
use Rudolf\Framework\Model\FrontModel;

class Model extends FrontModel
{
    public function check()
    {
        $auth = new Auth($this->pdo, $this->prefix);

        return $auth->check();
    }

    public function login($email, $password)
    {
        $auth = new Auth($this->pdo, $this->prefix);
        $status = $auth->login($email, $password);

        return $status;
    }

    public function logout()
    {
        $auth = new Auth($this->pdo, $this->prefix);
        $auth->logout();
    }
}
