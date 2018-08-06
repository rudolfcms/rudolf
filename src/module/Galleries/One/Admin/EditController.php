<?php

namespace Rudolf\Modules\Galleries\One\Admin;

use Rudolf\Framework\Controller\AdminController;
use Rudolf\Modules\Galleries\One;

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

        $form = new EditForm();
        $form->setModel($model);

        // if data was send
        if (!empty($_POST)) {
            $form->handle(array_merge($_POST, ['id' => $id]));

            if (isset($_POST['delete'])) {
                $model->delete($_POST);
            }

            if (isset($_FILES['photo_upload'])) {
                $model->upload($_FILES['photo_upload'], $_POST);
            }

            if ($form->isValid() && $form->update()) {
                $this->redirect(DIR.'/admin/galleries/edit/'.$id);
            }

            $form->displayAlerts();
        }

        $view = new EditView();
        $view->editGallery($form->getDataToDisplay((new One\Model())->getGalleryInfoById($id)));
        $view->render();
    }
}
