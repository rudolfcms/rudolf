<?php

namespace Rudolf\Modules\Albums\One\Admin;

use Rudolf\Component\Alerts\Alert;
use Rudolf\Component\Alerts\AlertsCollection;

class AddForm extends FormCheck
{
    /**
     * @var AddModel
     */
    private $model;

    /**
     * @param $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * @return int
     */
    public function save()
    {
        $status = $this->model->add($this->dataValidated);

        if ($status) {
            $album = new Album($this->dataValidated);
            AlertsCollection::add(new Alert(
                'success',
                'Pomyślnie dodano album.
                <a href="'.$album->url().'">Zobacz go</a>.'
            ));
        }

        return $status;
    }
}
