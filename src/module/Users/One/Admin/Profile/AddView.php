<?php

namespace Rudolf\Modules\Users\One\Admin\Profile;

use Rudolf\Framework\View\AdminView;
use Rudolf\Modules\Users\One\Admin\User;

class AddView extends AdminView
{
    protected $user;

    protected $path;

    public function display()
    {
        $this->pageTitle = _('Profile');
        $this->head->setTitle($this->pageTitle);

        $this->user         = new User();
        $this->path         = DIR.'/admin/users/add';
        $this->templateType = 'add';
        $this->template     = 'user-one';
    }
}
