<?php

namespace Rudolf\Modules\Appearance\Menu;

use Rudolf\Component\Alerts\Alert;
use Rudolf\Component\Alerts\AlertsCollection;
use Rudolf\Framework\Controller\AdminController;

class DelController extends AdminController
{
    /**
     * @param $id
     *
     * @throws \Exception
     */
    public function del($id)
    {
        if (isset($_POST['delete'])) {
            $model = new DelModel();
            if ($model->del($id)) {
                AlertsCollection::add(new Alert(
                    'success',
                    'Poprawnie usunięto!'
                ));
                $this->redirectTo(DIR.'/admin/appearance/menu');
                return;
            }
            AlertsCollection::add(new Alert(
                'success',
                'Coś się zepsuło!'
            ));
            $this->redirectTo(DIR.'/admin/appearance/menu/del/'.$id);
        }

        $view = new DelView();
        $view->display((new EditModel())->getInfo($id));
        $view->render('admin');
    }
}
