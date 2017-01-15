<?php

namespace Rudolf\Modules\Galleries\One\Admin;

use Rudolf\Framework\Controller\AdminController;
use Rudolf\Modules\Galleries\One;

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
                $this->redirect(DIR.'/admin/galleries');
            }

            $form->dispalyAlerts();
        }

        $gallery = (new One\Model())->getGalleryInfoById($id);

        $view = new DelView();
        $view->delGallery($gallery);
        $view->render('admin');
    }
}
