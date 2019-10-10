<?php

namespace Rudolf\Modules\Articles\One\Admin;

use Exception;
use Rudolf\Framework\Controller\AdminController;
use Rudolf\Modules\Categories\Roll\Admin\Model as CategoriesRoll;

class AddController extends AdminController
{
    /**
     * @throws Exception
     */
    public function add()
    {
        $categories = new CategoriesRoll();
        $categoriesList = $categories->getAll('articles');

        $addModel = new AddModel();

        $form = new AddForm();
        $form->setModel($addModel);

        // if data was send
        if (isset($_POST['add'])) {
            $form->handle($_POST);

            if ($form->isValid()) {
                $id = $form->save();
                $addModel->flushCache('articles');
                $this->redirect(DIR . '/admin/articles/edit/' . $id);
            }

            $form->displayAlerts();
        }

        $view = new AddView();
        $view->addArticle($form->getDataToDisplay());
        $view->setCategories($categoriesList);
        $view->render();
    }
}
