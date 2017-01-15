<?php

namespace Rudolf\Modules\Albums\One\Admin;

use Rudolf\Modules\Albums\One\Album;
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
            $album = new Album($this->dataValidated);
            AlertsCollection::add(new Alert(
                'success', 'Pomyślnie zmodyfikowano album.
                <a href="'.$album->url().'">Zobacz go</a>.'
            ));
        }

        return $status;
    }
}
