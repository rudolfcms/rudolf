<?php

namespace Rudolf\Modules\Users\One\Admin\Profile;

use Rudolf\Framework\View\AdminView;

class ShowView extends AdminView
{
    public function userCard()
    {
        $this->pageTitle = _('Profile');
        $this->head->setTitle($this->pageTitle);

        $this->template = 'profile';
    }
}
