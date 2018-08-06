<?php

namespace Rudolf\Modules\Galleries\One\Admin;

use Rudolf\Framework\Controller\AdminController;

class AddController extends AdminController
{
    /**
     * @throws \Exception
     */
    public function add()
    {
        $model = new AddModel();

        $form = new AddForm();
        $form->setModel($model);

        // if data was send
        if (!empty($_POST)) {
            $form->handle($_POST);

            if ($form->isValid() && $id = $form->add()) {
                $this->redirect(DIR.'/admin/galleries/edit/'.$id);
            }

            $form->displayAlerts();
        }

        $view = new AddView();
        $view->addGallery($form->getDataToDisplay());
        $view->render();
    }
}
