<?php

namespace Rudolf\Modules\Appearance\Menu\Type;

use Rudolf\Component\Alerts\Alert;
use Rudolf\Component\Alerts\AlertsCollection;
use Rudolf\Framework\Controller\AdminController;

class TypeDelController extends AdminController
{
    /**
     * @param $id
     *
     * @throws \Exception
     */
    public function del($id)
    {
        if (isset($_POST['delete'])) {
            $model = new TypeDelModel();
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
            $this->redirectTo(DIR.'/admin/appearance/menu/del-type/'.$id);
        }

        $view = new TypeDelView();
        $view->display((new TypeEditModel())->getMenuTypeById($id));
        $view->render();
    }
}
