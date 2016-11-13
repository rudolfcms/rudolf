<?php

namespace Rudolf\Modules\Albums\One\Admin;

use Rudolf\Component\Alerts\Alert;
use Rudolf\Component\Alerts\AlertsCollection;
use Rudolf\Component\Forms\Form;

class DelForm extends Form
{
    /**
     * @var DelModel
     */
    protected $model;

    public function setModel(DelModel $model)
    {
        $this->model = $model;
    }

    public function check()
    {
        $this->validator
            ->checkIsInt('id', $this->data['id'], [
                'not_int' => _('Album ID is not valid'),
            ]);

        $this->id = $this->data['id'];
    }

    public function delete()
    {
        $status = $this->model->delete($this->id);

        if ($status) {
            AlertsCollection::add(new Alert(
                'success', 'Pomyślnie usunięto album.'
            ));
        }

        return $status;
    }
}
