<?php

namespace Rudolf\Modules\Articles\One\Admin;

use Rudolf\Framework\Controller\AdminController;
use Rudolf\Modules\Articles\One\Model as OneModel;
use Rudolf\Modules\Categories\Roll\Admin\Model as CategoriesRoll;

class EditController extends AdminController
{
    public function edit($id)
    {
        $categories = new CategoriesRoll();
        $categoriesList = $categories->getAll('articles');

        $form = new EditForm();
        $form->setModel(new EditModel());

        // if data was send
        if (isset($_POST['update'])) {
            $form->handle(array_merge($_POST, ['id' => $id]));

            if ($form->isValid() and $form->update()) {
                $this->redirect(DIR.'/admin/articles/edit/'.$id);
            }

            $form->displayAlerts();
        }

        $view = new EditView();
        $view->editArticle($form->getDataToDisplay((new OneModel())->getOneById($id)));
        $view->setCategories($categoriesList);
        $view->render('admin');
    }
}
