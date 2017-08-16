<?php

namespace Rudolf\Modules\Users\One\Login;

use Rudolf\Component\Auth\Auth;
use Rudolf\Framework\Model\FrontModel;

class Model extends FrontModel
{
    public function check()
    {
        $auth = new Auth($this->pdo, $this->prefix);

        return $auth->check();
    }

    /**
     * @param string $email
     * @param string $password
     *
     * @return int
     */
    public function login($email, $password)
    {
        $auth = new Auth($this->pdo, $this->prefix);

        return $auth->login($email, $password);
    }
}
