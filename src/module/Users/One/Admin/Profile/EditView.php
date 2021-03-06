<?php

namespace Rudolf\Modules\Users\One\Admin\Profile;

use Rudolf\Framework\View\AdminView;
use Rudolf\Modules\Users\One\Admin\User;

class EditView extends AdminView
{
    /**
     * @var User
     */
    protected $user;

    protected $path;

    public function display(array $user)
    {
        $this->pageTitle = _('Profile');
        $this->head->setTitle($this->pageTitle);
        $this->user = new User($user);

        $this->path = $this->user->editUrl();
        $this->templateType = 'edit';
        $this->template = 'user-one';
    }
}
