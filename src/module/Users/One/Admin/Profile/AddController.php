<?php

namespace Rudolf\Modules\Users\One\Admin\Profile;

use Rudolf\Component\Alerts\Alert;
use Rudolf\Component\Alerts\AlertsCollection;
use Rudolf\Framework\Controller\AdminController;

class AddController extends AdminController
{
    /**
     * @throws \Exception
     */
    public function add()
    {
        if (isset($_POST['add'])) {
            if (empty($_POST['password']) || trim($_POST['password']) !== $_POST['password_again']) {
                AlertsCollection::add(
                    new Alert(
                        'error',
                        'Podane hasła nie są identyczne!'
                    )
                );
                $this->redirect(DIR.'/admin/users/add');
            }

            $id = (new AddModel())->add($_POST);

            if ($id) {
                AlertsCollection::add(
                    new Alert(
                        'success',
                        'Dodano użytkownika'
                    )
                );
                $this->redirect(DIR.'/admin/users/edit/'.$id);
            }
            AlertsCollection::add(
                new Alert(
                    'error',
                    'Wystąpił nieoczekiwany błąd'
                )
            );
        }
        $view = new AddView();
        $view->display();
        $view->render();
    }
}
