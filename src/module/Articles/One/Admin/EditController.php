<?php

namespace Rudolf\Modules\Articles\One\Admin;

use Exception;
use Rudolf\Framework\Controller\AdminController;
use Rudolf\Modules\Articles\One\Model as OneModel;
use Rudolf\Modules\Categories\Roll\Admin\Model as CategoriesRoll;

class EditController extends AdminController
{
    /**
     * @param $id
     *
     * @throws Exception
     */
    public function edit($id)
    {
        $categories = new CategoriesRoll();
        $categoriesList = $categories->getAll('articles');

        $editModel = new EditModel();
        $form = new EditForm();
        $form->setModel($editModel);

        // if data was send
        if (isset($_POST['update'])) {
            $form->handle(array_merge($_POST, ['id' => $id]));

            if ($form->isValid() && $form->update()) {
                $editModel->flushCache('articles');
                $this->redirect(DIR . '/admin/articles/edit/' . $id);
            }

            $form->displayAlerts();
        }

        $view = new EditView();
        $view->editArticle($form->getDataToDisplay((new OneModel())->getOneById($id)));
        $view->setCategories($categoriesList);
        $view->render();
    }
}
