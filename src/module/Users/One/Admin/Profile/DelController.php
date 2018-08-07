<?php

namespace Rudolf\Modules\Users\One\Admin\Profile;

use Rudolf\Component\Alerts\Alert;
use Rudolf\Component\Alerts\AlertsCollection;
use Rudolf\Framework\Controller\AdminController;

class DelController extends AdminController
{
    /**
     * @param $id
     *
     * @throws \Exception
     */
    public function del($id)
    {
        if (isset($_POST['delete'])) {
            if ((new DelModel())->del($id)) {
                AlertsCollection::add(new Alert(
                    'success',
                    'Poprawnie usunięto użytkownika'
                ));
                $this->redirect(DIR.'/admin/users');
            } else {
                AlertsCollection::add(new Alert(
                    'error',
                    'Wystąpił nieoczekiwany błąd'
                ));
            }
        }

        $view = new DelView();
        $view->display((new EditModel())->getUserInfoById($id));
        $view->render();
    }
}
