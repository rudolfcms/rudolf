<?php

namespace Rudolf\Modules\Modules\One\Admin;

use Rudolf\Component\Modules\ConfigEditor;
use Rudolf\Framework\Controller\AdminController;

class SwitchController extends AdminController
{
    public function switchStatus($name)
    {
        $configEditor = new ConfigEditor();

        $status = $configEditor->getStatus($name);

        if (null === $status) {
            // TODO: trigger alerts
            $this->redirect(DIR.'/admin/modules');
        }

        switch ($status) {
            case 1:
                $configEditor->deactivate($name);
                $configEditor->save();
                // TODO: trigger alerts
                $this->redirect(DIR.'/admin/modules?de', 302);
                break;

            case 0:
                $configEditor->activate($name);
                $configEditor->save();
                // TODO: trigger alerts
                $this->redirect(DIR.'/admin/modules?ac', 302);
                break;
        }
    }
}
