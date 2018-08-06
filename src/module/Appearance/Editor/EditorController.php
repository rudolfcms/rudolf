<?php

namespace Rudolf\Modules\Appearance\Editor;

use Rudolf\Component\Alerts\Alert;
use Rudolf\Component\Alerts\AlertsCollection;
use Rudolf\Framework\Controller\AdminController;

class EditorController extends AdminController
{
    /**
     * Editor.
     *
     * @param string $file Filename in base64, default templates/_header.html.php
     *
     * @return void
     * @throws \Exception
     */
    public function editor($file)
    {
        if ('/admin/appearance/editor' === $file) {
            $this->redirectTo('/admin/appearance/editor/file/dGVtcGxhdGVzL19oZWFkLmh0bWwucGhw');
        }

        $model = new EditorModel();

        $filesList['templates'] = $model->getFilesListByPath('templates');
        $filesList['css'] = $model->getFilesListByPath('css');
        $filesList['js'] = $model->getFilesListByPath('js');

        $filename = base64_decode($file);

        // if data was send
        if (isset($_POST['save'])) {
            /** @var array $_POST */
            if ($model->saveFile($filename, $_POST['content'])) {
                AlertsCollection::add(new Alert(
                    'success',
                    'Pomyślnie zapisano plik szablonu '.$filename.'.'
                ));
            } else {
                AlertsCollection::add(new Alert(
                    'error',
                    'Coś poszło nie tak podczas zapisywania pliku '.$filename.'. '.
                    'Sprawdź prawa dostępu'
                ));
            }

            $this->redirectTo($file);
        }

        $view = new EditorView();
        $view->editor($filesList, $model->getFileInfo($filename));
        $view->render();
    }
}
