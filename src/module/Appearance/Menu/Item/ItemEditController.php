<?php

namespace Rudolf\Modules\Appearance\Menu\Item;

use Rudolf\Component\Alerts\Alert;
use Rudolf\Component\Alerts\AlertsCollection;
use Rudolf\Framework\Controller\AdminController;
use Rudolf\Framework\Model\FrontModel;
use Rudolf\Modules\Appearance\Menu\Model;

class ItemEditController extends AdminController
{
    /**
     * @param $id
     *
     * @throws \Exception
     */
    public function edit($id)
    {
        $model = new ItemEditModel();
        $view  = new ItemEditView();

        if (isset($_POST['update'])) {
            if ($model->edit($id, $_POST)) {
                AlertsCollection::add(new Alert(
                    'success',
                    'Zaktualizowano!'
                ));
                $this->redirectTo(DIR.'/admin/appearance/menu/edit-item/'.$id);

                return;
            }
            AlertsCollection::add(new Alert(
                'error',
                'Coś się zepsuło!'
            ));
        }

        $view->display($model->getInfo($id), (new Model())->getTypes(), (new FrontModel())->getMenuItems());
        $view->render('admin');
    }
}
