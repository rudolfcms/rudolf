<?php

namespace Rudolf\Modules\Articles\Category\One\Admin;

use Rudolf\Component\Http\Response;
use Rudolf\Framework\Controller\AdminController;
use Rudolf\Modules\Categories\One\Admin\AddForm;
use Rudolf\Modules\Categories\One\Admin\AddModel;

class AddController extends AdminController
{
    public function add()
    {
        $form = new AddForm();
        $form->setModel(new AddModel());
        $form->setType('articles');

        // if data was send
        if (isset($_POST['add'])) {
            $form->handle($_POST);

            if ($form->isValid()) {
                $id = $form->save();
                $this->redirect(DIR.'/admin/articles/categories/edit/'.$id);
            }

            $form->dispalyAlerts();
        }

        $view = new AddView();
        $view->add($form->getDataToDisplay());
        $view->render('admin');
    }
}
