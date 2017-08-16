<?php

namespace Rudolf\Modules\Galleries\One\Admin;

use Rudolf\Component\Forms\Form;
use Rudolf\Component\Alerts\Alert;
use Rudolf\Component\Alerts\AlertsCollection;

class DelForm extends Form
{
    /**
     * @var DelModel
     */
    protected $model;

    /**
     * @var int
     */
    protected $id;

    /**
     * @param DelModel $model
     */
    public function setModel(DelModel $model)
    {
        $this->model = $model;
    }

    public function check()
    {
        $this->validator
            ->checkIsInt('id', $this->data['id'], [
                'not_int' => _('Page ID is not valid'),
            ]);

        $this->id = $this->data['id'];
    }

    public function delete()
    {
        $status = $this->model->delete($this->id);

        if ($status) {
            AlertsCollection::add(new Alert(
                'success',
                'Pomyślnie usunięto galerię.'
            ));
        }

        return $status;
    }
}
