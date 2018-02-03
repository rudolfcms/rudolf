<?php

namespace Rudolf\Modules\Albums\One\Admin;

use Rudolf\Framework\Controller\AdminController;
use Rudolf\Modules\Categories\Roll\Admin\Model as CategoriesRoll;

class AddController extends AdminController
{
    /**
     * @throws \Exception
     */
    public function add()
    {
        $categories = new CategoriesRoll();
        $categoriesList = $categories->getAll('albums');

        $form = new AddForm();
        $form->setModel(new AddModel());

        // if data was send
        if (isset($_POST['add'])) {
            $form->handle($_POST);

            if ($form->isValid()) {
                $id = $form->save();
                $this->redirect(DIR.'/admin/albums/edit/'.$id);
            }

            $form->displayAlerts();
        }

        $view = new AddView();
        $view->addAlbum($form->getDataToDisplay());
        $view->setCategories($categoriesList);
        $view->render('admin');
    }
}
