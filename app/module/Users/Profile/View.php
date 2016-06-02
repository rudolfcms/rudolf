<?php
namespace Rudolf\Modules\Users\Profile;

use Rudolf\Modules\A_admin\AdminView;

class View extends AdminView
{
    public function userCard()
    {
        $this->head->setTitle(_('Profile'));

        $this->template = 'profile';
    }
}
