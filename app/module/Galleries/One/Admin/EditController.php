<?php

namespace Rudolf\Modules\Galleries\One\Admin;

use Rudolf\Framework\Controller\AdminController;
use Rudolf\Modules\Galleries\One;

class EditController extends AdminController
{
    public function edit($id)
    {

        $form = new EditForm();
        $form->setModel(new EditModel());

        // if data was send
        if (isset($_POST['update'])) {
            $form->handle(array_merge($_POST, ['id' => $id]));

            if ($form->isValid() and $form->update()) {
                $this->redirect(DIR.'/admin/galleries/edit/'.$id);
            }

            $form->dispalyAlerts();
        }

        $view = new EditView();
        $view->editGallery($form->getDataToDisplay((new One\Model())->getGalleryInfoById($id)));
        $view->render('admin');
    }
}
