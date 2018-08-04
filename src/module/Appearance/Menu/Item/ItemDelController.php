<?php

namespace Rudolf\Modules\Appearance\Menu\Item;

use Rudolf\Component\Alerts\Alert;
use Rudolf\Component\Alerts\AlertsCollection;
use Rudolf\Framework\Controller\AdminController;

class ItemDelController extends AdminController
{
    /**
     * @param $id
     *
     * @throws \Exception
     */
    public function del($id)
    {
        if (isset($_POST['delete'])) {
            $model = new ItemDelModel();
            if ($model->del($id)) {
                AlertsCollection::add(new Alert(
                    'success',
                    'Poprawnie usunięto!'
                ));
                $this->redirectTo(DIR.'/admin/appearance/menu');
                return;
            }
            AlertsCollection::add(new Alert(
                'error',
                'Coś się zepsuło!'
            ));
            $this->redirectTo(DIR.'/admin/appearance/menu/del/'.$id);
        }

        $view = new ItemDelView();
        $view->display((new ItemEditModel())->getInfo($id));
        $view->render('admin');
    }
}
