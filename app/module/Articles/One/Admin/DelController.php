<?php

namespace Rudolf\Modules\Articles\One\Admin;

use Rudolf\Framework\Controller\AdminController;
use Rudolf\Modules\Articles\One\Model as OneModel;

class DelController extends AdminController
{
    public function del($id)
    {
        // if data was send
        if (isset($_POST['delete'])) {
            $form = new DelForm();
            $form->handle(['id'=>$id]);
            $form->setModel(new DelModel());

            if ($form->isValid()) {
                $form->delete();
                $this->redirect(DIR.'/admin/articles');
            }

            $form->dispalyAlerts();
        }

        $article = (new OneModel())->getOneById($id);

        $view = new DelView();
        $view->delArticle($article);
        $view->render('admin');
    }
}
