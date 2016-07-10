<?php
namespace Rudolf\Modules\Users\Login;

use Rudolf\Modules\A_front\FModel;
use Rudolf\Component\Auth\Auth;

class Model extends FModel
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
