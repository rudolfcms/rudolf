<?php

namespace Rudolf\Modules\Tools\Admin\One\DatabaseImport;

use Rudolf\Component\Alerts\Alert;
use Rudolf\Component\Alerts\AlertsCollection;
use Rudolf\Framework\Controller\AdminController;

class Controller extends AdminController
{
    /**
     * @throws \Exception
     */
    public function show()
    {
        if (isset($_POST['upload'])) {
            $error = 0;
            $file = $_FILES['sqlfile'];

            /** @var array $_FILES */
            if ($file['error'] !== UPLOAD_ERR_OK
                || !is_uploaded_file($file['tmp_name'])) {
                $error = 1;
                AlertsCollection::add(new Alert(
                    'error',
                    'Uszkodzony plik.',
                    ALERT::MODE_IMMEDIATELY
                ));
            } elseif ('application/sql' !== $file['type']) {
                $error = 1;
                AlertsCollection::add(new Alert(
                    'error',
                    'Nieprawidłowy plik. Tylko .sql.',
                    ALERT::MODE_IMMEDIATELY
                ));
            }

            if (0 === $error) {
                $model = new Model();
                $model->clear();
                $queries = $model->import(file_get_contents($file['tmp_name']));
                if ($queries) {
                    AlertsCollection::add(new Alert(
                        'success',
                        'Poprawnie zaimportowano ' . $file['name'].'! Wykonano '.$queries.' zapytań.'
                    ));
                    $this->redirectTo(DIR.'/admin/tools/db-import');
                } else {
                    AlertsCollection::add(new Alert(
                        'error',
                        'Nastąpił błąd podczas importu!',
                        ALERT::MODE_IMMEDIATELY
                    ));
                }
            }
        }

        $view = new View();
        $view->setData($data = []);
        $view->render('admin');
    }
}
