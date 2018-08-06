<?php

namespace Rudolf\Modules\Appearance\Menu\Type;

use Rudolf\Component\Alerts\Alert;
use Rudolf\Component\Alerts\AlertsCollection;
use Rudolf\Framework\Controller\AdminController;

class TypeAddController extends AdminController
{
    /**
     * @throws \Exception
     */
    public function add()
    {
        if (isset($_POST['add'])) {
            $model = new TypeAddModel();
            $id = $model->add($_POST);
            if ($id) {
                AlertsCollection::add(new Alert(
                    'success',
                    'Poprawnie dodano!'
                ));
                $this->redirectTo(DIR.'/admin/appearance/menu/edit-type/'.$id);
                return;
            }
            AlertsCollection::add(new Alert(
                'error',
                'Coś się zepsuło!'
            ));
            $item = new MenuType([
                'id' => -1,
                'title' => $_POST['title'],
                'menu_type' => $_POST['menu_type'],
                'description' => $_POST['description'],
            ]);
        } else {
            $item = new MenuType([
                'id' => -1,
                'title' => '',
                'menu_type' => '',
                'description' => ''
            ]);
        }

        $view = new TypeAddView();
        $view->display($item);
        $view->render();
    }
}
