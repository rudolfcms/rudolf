<?php

namespace Rudolf\Modules\Albums\One\Admin;

use Rudolf\Component\Http\HttpErrorException;
use Rudolf\Framework\Controller\AdminController;
use Rudolf\Modules\Albums\One\Model as OneModel;

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
                $this->redirect(DIR.'/admin/albums');
            }

            $form->displayAlerts();
        }

        $album = (new OneModel())->getOneById($id);

        if (empty($album)) {
            throw new HttpErrorException('Category not found', 404);
        }

        $view = new DelView();
        $view->delAlbum($album);
        $view->render('admin');
    }
}
