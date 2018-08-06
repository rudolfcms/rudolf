<?php

namespace Rudolf\Modules\Modules\One\Admin;

use Rudolf\Component\Alerts\Alert;
use Rudolf\Component\Alerts\AlertsCollection;
use Rudolf\Component\Modules\ConfigEditor;
use Rudolf\Framework\Controller\AdminController;

class SwitchController extends AdminController
{
    private $blacklist = [
        'Dashboard',
        'Modules',
        'Users',
    ];

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
            $this->redirect(DIR.'/admin/modules');
        }

        switch ($status) {
            case 1:
                if (in_array($name, $this->blacklist)) {
                    AlertsCollection::add(new Alert(
                        'error',
                        'Nie można wyłączyć modułu '.$name.'.'
                    ));
                    $this->redirect(DIR.'/admin/modules?de', 302);
                    break;
                }

                $configEditor->deactivate($name);
                $configEditor->save();
                AlertsCollection::add(new Alert(
                    'success',
                    'Pomyślnie wyłączono moduł '.$name.'.'
                ));
                $this->redirect(DIR.'/admin/modules?de', 302);
                break;

            case 0:
                $configEditor->activate($name);
                $configEditor->save();
                AlertsCollection::add(new Alert(
                    'success',
                    'Pomyślnie włączono moduł '.$name.'.'
                ));
                $this->redirect(DIR.'/admin/modules?ac', 302);
                break;
        }
    }
}
