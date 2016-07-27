<?php

namespace Rudolf\Modules\Albums\One\Admin;

use Rudolf\Framework\Controller\AdminController;
use Rudolf\Modules\Albums\One;
use Rudolf\Modules\Categories\Roll\Admin\Model as CategoriesRoll;

class EditController extends AdminController
{
    public function edit($id)
    {
        $categories = new CategoriesRoll();
        $categoriesList = $categories->getAll('albums');
        $album = (new One\Model())->getOneById($id);

        $form = new EditForm();
        $form->setModel(new EditModel());

        // if data was send
        if (isset($_POST['update'])) {
            $form->handle(array_merge($_POST, ['id' => $id]));

             if ($form->isValid() and $form->update()) {
                $this->redirect(DIR.'/admin/albums/edit/'.$id);
            }

            $form->dispalyAlerts();
            $album = array_merge($album, $form->getDataToDisplay());
        }

        $view = new EditView();
        $view->editAlbum($album);
        $view->setCategories($categoriesList);
        $view->render('admin');
    }
}
