<?php

namespace Rudolf\Modules\Pages\One\Admin;

use Rudolf\Framework\Controller\AdminController;
use Rudolf\Modules\Pages\Roll\Model as PagesList;

class AddController extends AdminController
{
    public function add()
    {
        $form = new AddForm();
        $form->setModel(new AddModel());

        // if data was send
        if (isset($_POST['add'])) {
            $form->handle($_POST);

            if ($form->isValid()) {
                $id = $form->save();
                $this->redirect(DIR.'/admin/pages/edit/'.$id);
            }

            $form->displayAlerts();
        }

        $view = new AddView();
        $view->addPage($form->getDataToDisplay());
        $view->setPages((new PagesList())->getPagesList());
        $view->render('admin');
    }
}
