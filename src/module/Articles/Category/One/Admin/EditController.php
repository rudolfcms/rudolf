<?php

namespace Rudolf\Modules\Articles\Category\One\Admin;

use Rudolf\Component\Http\HttpErrorException;
use Rudolf\Framework\Controller\AdminController;
use Rudolf\Modules\Categories\One;
use Rudolf\Modules\Categories\One\Admin\EditForm;
use Rudolf\Modules\Categories\One\Admin\EditModel;

class EditController extends AdminController
{
    public function edit($id)
    {
        $form = new EditForm();
        $form->setModel(new EditModel());
        $form->setType('articles');

        // if data was send
        if (isset($_POST['update'])) {
            $form->handle(array_merge($_POST, ['id' => $id]));

            if ($form->isValid() and $form->update()) {
                $this->redirect(DIR.'/admin/articles/categories/edit/'.$id);
            }

            $form->displayAlerts();
        }

        $category = $form->getDataToDisplay((new One\Model())->getCategoryInfoById($id));

        if (!$category) {
            throw new HttpErrorException('Category not found', 404);
        }

        $view = new EditView();
        $view->edit($category);
        $view->render('admin');
    }
}
