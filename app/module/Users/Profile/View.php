<?php
namespace Rudolf\Modules\Users\Profile;

use Rudolf\Framework\View\AdminView;

class View extends AdminView
{
    public function userCard()
    {
        $this->head->setTitle(_('Profile'));

        $this->template = 'profile';
    }
}
