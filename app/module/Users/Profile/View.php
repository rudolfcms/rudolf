<?php
namespace Rudolf\Modules\Users\Profile;

use Rudolf\Framework\View\AdminView;

class View extends AdminView
{
    public function userCard()
    {
        $this->head->setTitle($this->pageTitle());

        $this->template = 'profile';
    }

    public function pageTitle()
    {
        return _('Profile');
    }
}
