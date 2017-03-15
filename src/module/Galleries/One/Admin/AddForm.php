<?php

namespace Rudolf\Modules\Galleries\One\Admin;

use Rudolf\Component\Alerts\Alert;
use Rudolf\Component\Alerts\AlertsCollection;

class AddForm extends FormCheck
{
    /**
     * @var AddModel
     */
    protected $model;

    public function setModel(AddModel $model)
    {
        $this->model = $model;
    }

    /**
     * @return int
     */
    public function add()
    {
        $status = $this->model->add($this->dataValidated);

        if ($status) {
            AlertsCollection::add(new Alert(
                'success', 'Pomyślnie dodano galerię.'
            ));
        }

        return $status;
    }
}
