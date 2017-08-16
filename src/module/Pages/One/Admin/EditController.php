<?php

namespace Rudolf\Modules\Pages\One\Admin;

use Rudolf\Component\Http\HttpErrorException;
use Rudolf\Framework\Controller\AdminController;
use Rudolf\Modules\Pages\One\Model as PageOne;
use Rudolf\Modules\Pages\Roll\Model as PagesList;

class EditController extends AdminController
{
    public function edit($id)
    {
        $form = new EditForm();
        $form->setModel(new EditModel());

        $page = new PageOne();
        if (false === ($pageData = $page->getOneById($id))) {
            throw new HttpErrorException('No page found (error 404)', 404);
        }

        // if data was send
        if (isset($_POST['update'])) {
            $form->handle(array_merge($_POST, ['id' => $id]));

            if ($form->isValid() and $form->update()) {
                $this->redirect(DIR.'/admin/pages/edit/'.$id);
            }

            $form->displayAlerts();
        }

        $pagesList = new PagesList();
        $view = new EditView();
        $view->editPage(
            $form->getDataToDisplay(
                $page->addToPageUrl(
                    $pageData,
                    $pagesList->getPagesList()
                )
            )
        );
        $view->setPages($pagesList->getPagesList());
        $view->render('admin');
    }
}
