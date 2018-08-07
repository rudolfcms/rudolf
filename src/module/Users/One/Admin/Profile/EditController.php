<?php

namespace Rudolf\Modules\Users\One\Admin\Profile;

use Rudolf\Component\Alerts\Alert;
use Rudolf\Component\Alerts\AlertsCollection;
use Rudolf\Framework\Controller\AdminController;

class EditController extends AdminController
{
    /**
     * @param $id
     *
     * @throws \Exception
     */
    public function edit($id)
    {
        $model = new EditModel();

        if (!empty($_POST)) {
            if (!empty($_POST['password'])) {
                if (trim($_POST['password']) === $_POST['password_again'] && $model->updatePassword($id, $_POST['password'])) {
                    AlertsCollection::add(
                        new Alert(
                            'success',
                            'Zaktualizowano hasło'
                        )
                    );
                } else {
                    AlertsCollection::add(
                        new Alert(
                            'error',
                            'Podane hasła nie są identyczne!'
                        )
                    );
                }
            }

            if ($model->edit($id, $_POST)) {
                AlertsCollection::add(
                    new Alert(
                        'success',
                        'Zaktualizowano profil (bez zmiany hasła)'
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

        $view = new EditView();
        $view->display($model->getUserInfoById($id));
        $view->render();
    }
}
