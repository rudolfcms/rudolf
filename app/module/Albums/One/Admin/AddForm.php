<?php

namespace Rudolf\Modules\Albums\One\Admin;

use Rudolf\Modules\Albums\One\Album;
use Rudolf\Component\Alerts\Alert;
use Rudolf\Component\Alerts\AlertsCollection;

class AddForm extends FormCheck
{
    protected $model;

    public function setModel(AddModel $model)
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
                'success', 'Pomyślnie dodano album.
                <a href="'.$album->url().'">Zobacz go</a>.'
            ));
        }

        return $status;
    }
}
