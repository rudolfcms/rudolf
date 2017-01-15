<?php

namespace Rudolf\Modules\Users\One\Admin;

use Rudolf\Modules\Users\One;

class User extends One\User
{
    public function editUrl()
    {
        return DIR.'/admin/users/edit/'.$this->id();
    }

    public function delUrl()
    {
        return DIR.'/admin/users/del/'.$this->id();
    }
}
