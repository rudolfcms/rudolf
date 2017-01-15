<?php

namespace Rudolf\Modules\Galleries\One\Admin;

use Rudolf\Framework\Controller\AdminController;

class AddController extends AdminController
{
    public function add()
    {
        $model = new AddModel();

        $form = new AddForm();
        $form->setModel($model);

        // if data was send
        if (!empty($_POST)) {
            $form->handle($_POST);

            if ($form->isValid() and $id = $form->add($_POST)) {
                $this->redirect(DIR.'/admin/galleries/edit/'.$id);
            }

            $form->dispalyAlerts();
        }

        $view = new AddView();
        $view->addGallery($form->getDataToDisplay());
        $view->render('admin');
    }
}
