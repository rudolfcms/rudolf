<?php

namespace Rudolf\Modules\Albums\Category\One\Admin;

use Exception;
use Rudolf\Component\Http\HttpErrorException;
use Rudolf\Framework\Controller\AdminController;
use Rudolf\Modules\Categories\One\Admin\DelForm;
use Rudolf\Modules\Categories\One\Admin\DelModel;
use Rudolf\Modules\Categories\One\Model as OneModel;

class DelController extends AdminController
{
    /**
     * @param $id
     *
     * @throws HttpErrorException
     * @throws Exception
     */
    public function del($id)
    {
        // if data was send
        if (isset($_POST['delete'])) {
            $delModel = new DelModel();
            $form = new DelForm();
            $form->handle(['id' => $id]);
            $form->setModel($delModel);

            if ($form->isValid()) {
                $form->delete();
                $delModel->flushCache('categories');
                $this->redirect(DIR . '/admin/albums/categories');
            }

            $form->displayAlerts();
        }

        $category = (new OneModel())->getCategoryInfoById($id);

        if (empty($category)) {
            throw new HttpErrorException('Category not found', 404);
        }

        $view = new DelView();
        $view->delCategory($category);
        $view->render();
    }
}
