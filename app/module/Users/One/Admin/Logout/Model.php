<?php

namespace Rudolf\Modules\Users\One\Admin\Logout;

use Rudolf\Component\Auth\Auth;
use Rudolf\Framework\Model\AdminModel;

class Model extends AdminModel
{
    public function logout()
    {
        $auth = new Auth($this->pdo, $this->prefix);
        $auth->logout();
    }
}
