<?php

namespace Rudolf\Modules\Pages\One\Admin;

use Rudolf\Framework\Controller\AdminController;
use Rudolf\Modules\Pages\One\Model as OneModel;

class DelController extends AdminController
{
    public function del($id)
    {
        // if data was send
        if (isset($_POST['delete'])) {
            $form = new DelForm();
            $form->handle(['id' => $id]);
            $form->setModel(new DelModel());

            if ($form->isValid()) {
                $form->delete();
                $this->redirect(DIR.'/admin/pages');
            }

            $form->dispalyAlerts();
        }

        $page = (new OneModel())->getOneById($id);

        $view = new DelView();
        $view->delPage($page);
        $view->render('admin');
    }
}
