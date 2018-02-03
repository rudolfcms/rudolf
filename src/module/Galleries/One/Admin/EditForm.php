<?php

namespace Rudolf\Modules\Galleries\One\Admin;

use Rudolf\Component\Alerts\Alert;
use Rudolf\Component\Alerts\AlertsCollection;

class EditForm extends FormCheck
{
    /**
     * @var EditModel
     */
    protected $model;

    /**
     * @param EditModel $model
     */
    public function setModel(EditModel $model)
    {
        $this->model = $model;
    }

    /**
     * @return int
     * @throws \Exception
     */
    public function update()
    {
        $status = $this->model->update($this->dataValidated);

        if ($status) {
            AlertsCollection::add(new Alert(
                'success',
                'Pomyślnie zmodyfikowano galerię.'
            ));
        }

        return $status;
    }
}
