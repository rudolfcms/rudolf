<?php

namespace Rudolf\Modules\Pages\One\Admin;

use Rudolf\Framework\Controller\AdminController;
use Rudolf\Modules\Pages\One;
use Rudolf\Modules\Pages\Roll\Model as PagesList;

class EditController extends AdminController
{
	public function edit($id)
	{
		$form = new EditForm();
        $form->setModel(new EditModel());

        // if data was send
        if (isset($_POST['update'])) {
            $form->handle(array_merge($_POST, ['id' => $id]));

            if ($form->isValid() and $form->update()) {
                $this->redirect(DIR.'/admin/pages/edit/'.$id);
            }

            $form->dispalyAlerts();
        }

        $pages = new PagesList();
        $view = new EditView();
        $view->editPage(
            $form->getDataToDisplay((new One\Model())->getOneById($id)),
            $pages->getPagesList($simple = true)
        );
        $view->setPages($pages->getPagesList($simple = true));
        $view->render('admin');
	}
}
