<?php

namespace Rudolf\Modules\Appearance\One\Admin;

use Rudolf\Component\Alerts\Alert;
use Rudolf\Component\Alerts\AlertsCollection;
use Rudolf\Framework\Controller\AdminController;
use Rudolf\Modules\Appearance\ThemeConfigEditor;

class SwitchController extends AdminController
{
    public function switchTheme($name)
    {
        $confEditor = new ThemeConfigEditor();

        $confEditor->setThemeName($name);
        $confEditor->save();

        AlertsCollection::add(new Alert(
            'success',
            'Pomyślnie zmieniono szablon domyślny na '.$name.'.'
        ));

        $this->redirect(DIR.'/admin/appearance', 302);
    }
}
