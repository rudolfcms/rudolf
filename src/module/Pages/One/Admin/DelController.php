<?php

namespace Rudolf\Modules\Pages\One\Admin;

use Rudolf\Framework\Controller\AdminController;
use Rudolf\Modules\Pages\One\Model as OneModel;

class DelController extends AdminController
{
    /**
     * @param $id
     *
     * @throws \Exception
     */
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

            $form->displayAlerts();
        }

        $page = (new OneModel())->getOneById($id);

        $view = new DelView();
        $view->delPage($page);
        $view->render();
    }
}
