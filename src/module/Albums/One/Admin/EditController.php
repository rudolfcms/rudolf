<?php

namespace Rudolf\Modules\Albums\One\Admin;

use Rudolf\Component\Http\HttpErrorException;
use Rudolf\Framework\Controller\AdminController;
use Rudolf\Modules\Albums\One;
use Rudolf\Modules\Categories\Roll\Admin\Model as CategoriesRoll;

class EditController extends AdminController
{
    /**
     * @param $id
     *
     * @throws HttpErrorException
     * @throws \Exception
     */
    public function edit($id)
    {
        $categories = new CategoriesRoll();
        $categoriesList = $categories->getAll('albums');

        $form = new EditForm();
        $form->setModel(new EditModel());

        // if data was send
        if (isset($_POST['update'])) {
            $form->handle(array_merge($_POST, ['id' => $id]));

            if ($form->isValid() and $form->update()) {
                $this->redirect(DIR.'/admin/albums/edit/'.$id);
            }

            $form->displayAlerts();
        }

        $album = $form->getDataToDisplay((new One\Model())->getOneById($id));

        if (empty($album)) {
            throw new HttpErrorException('Category not found', 404);
        }

        $view = new EditView();
        $view->editAlbum($album);
        $view->setCategories($categoriesList);
        $view->render('admin');
    }
}
