<?php

namespace Rudolf\Modules\Galleries\One\Admin;

use Exception;
use Rudolf\Framework\Controller\AdminController;
use Rudolf\Modules\Galleries\One;

class DelController extends AdminController
{
    /**
     * @param $id
     *
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
                $delModel->flushCache('galleries');
                $this->redirect(DIR . '/admin/galleries');
            }

            $form->displayAlerts();
        }

        $gallery = (new One\Model())->getGalleryInfoById($id);

        $view = new DelView();
        $view->delGallery($gallery);
        $view->render();
    }
}
