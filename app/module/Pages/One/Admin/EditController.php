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

        $pagesList = new PagesList();
        $page = new One\Model();
        $view = new EditView();
        $view->editPage(
            $form->getDataToDisplay(
                $page->addToPageUrl(
                    $page->getOneById($id),
                    $pagesList->getPagesList()
                )
            )
        );
        $view->setPages($pagesList->getPagesList());
        $view->render('admin');
	}
}
