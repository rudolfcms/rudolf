<?php

namespace Rudolf\Modules\Categories\One\Admin;

use Rudolf\Component\Alerts\Alert;
use Rudolf\Component\Alerts\AlertsCollection;

class EditForm extends FormCheck
{
    /**
     * @var EditModel
     */
    protected $model;

    public function setModel(EditModel $model)
    {
        $this->model = $model;
    }

    /**
     * @return int
     */
    public function update()
    {
        $status = $this->model->update($this->dataValidated);

        if ($status) {
            AlertsCollection::add(new Alert(
                'success', 'Pomyślnie zmodyfikowano kategorię.'
            ));
        }

        return $status;
    }
}
