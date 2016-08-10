<?php

namespace Rudolf\Modules\Albums\Category\One\Admin;

use Rudolf\Framework\Controller\AdminController;
use Rudolf\Modules\Categories\One;
use Rudolf\Modules\Categories\One\Admin\EditForm;
use Rudolf\Modules\Categories\One\Admin\EditModel;

class EditController extends AdminController
{
    public function edit($id)
    {
        $form = new EditForm();
        $form->setModel(new EditModel());
        $form->setType('albums');

        // if data was send
        if (isset($_POST['update'])) {
            $form->handle(array_merge($_POST, ['id' => $id]));

            if ($form->isValid() and $form->update()) {
                $this->redirect(DIR.'/admin/albums/categories/edit/'.$id);
            }

            $form->dispalyAlerts();
        }

        $view = new EditView();
        $view->edit($form->getDataToDisplay((new One\Model())->getCategoryInfoById($id)));
        $view->render('admin');
    }
}
