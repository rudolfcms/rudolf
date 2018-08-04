<?php

namespace Rudolf\Modules\Appearance\Menu\Type;

use Rudolf\Component\Alerts\Alert;
use Rudolf\Component\Alerts\AlertsCollection;
use Rudolf\Framework\Controller\AdminController;

class TypeEditController extends AdminController
{
    /**
     * @param $id
     *
     * @throws \Exception
     */
    public function edit($id)
    {
        $model = new TypeEditModel();
        $view = new TypeEditView();

        if (isset($_POST['update'])) {
            if ($model->edit($id, $_POST)) {
                AlertsCollection::add(new Alert(
                    'success',
                    'Zaktualizowano!'
                ));
                $this->redirectTo(DIR.'/admin/appearance/menu/edit-type/'.$id);
                return;
            }
            AlertsCollection::add(new Alert(
                'error',
                'Coś się zepsuło!'
            ));
        }

        $view->display($model->getMenuTypeById($id));
        $view->render('admin');
    }
}
