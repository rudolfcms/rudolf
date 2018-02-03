<?php

namespace Rudolf\Modules\Plugins\One\Admin;

use Rudolf\Component\Alerts\Alert;
use Rudolf\Component\Alerts\AlertsCollection;
use Rudolf\Component\Plugins\ConfigEditor;
use Rudolf\Framework\Controller\AdminController;

class SwitchController extends AdminController
{
    /**
     * @param $name
     *
     * @throws \Exception
     */
    public function switchStatus($name)
    {
        $configEditor = new ConfigEditor();

        $status = $configEditor->getStatus($name);

        if (null === $status) {
            AlertsCollection::add(new Alert(
                'error',
                'Wystąpił nieoczekiwany błąd'
            ));
            $this->redirect(DIR.'/admin/plugins');
        }

        switch ($status) {
            case 1:
                $configEditor->deactivate($name);
                $configEditor->save();
                AlertsCollection::add(new Alert(
                    'success',
                    'Pomyślnie wyłączono wtyczkę '.$name.'.'
                ));
                $this->redirect(DIR.'/admin/plugins?de', 302);
                break;

            case 0:
                $configEditor->activate($name);
                $configEditor->save();
                AlertsCollection::add(new Alert(
                    'success',
                    'Pomyślnie włączono wtyczkę '.$name.'.'
                ));
                $this->redirect(DIR.'/admin/plugins?ac', 302);
                break;
        }
    }
}
