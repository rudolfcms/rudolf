<?php

namespace Rudolf\Modules\Plugins\One\Admin;

use Rudolf\Component\Plugins\ConfigEditor;
use Rudolf\Framework\Controller\AdminController;

class SwitchController extends AdminController
{
    public function switchStatus($name)
    {
        $configEditor = new ConfigEditor();

        $status = $configEditor->getStatus($name);

        if (null === $status) {
            // TODO: trigger alerts
            $this->redirect(DIR.'/admin/plugins');
        }

        switch ($status) {
            case 1:
                $configEditor->deactivate($name);
                $configEditor->save();
                // TODO: trigger alerts
                $this->redirect(DIR.'/admin/plugins?de', 302);
                break;

            case 0:
                $configEditor->activate($name);
                $configEditor->save();
                // TODO: trigger alerts
                $this->redirect(DIR.'/admin/plugins?ac', 302);
                break;
        }
    }
}
