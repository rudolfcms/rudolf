<?php

namespace Rudolf\Modules\Articles\One\Admin;

use Rudolf\Component\Alerts\Alert;
use Rudolf\Component\Alerts\AlertsCollection;
use Rudolf\Component\Forms\Form;

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
            ->checkIsInt('id', $this->data['id'], true, [
                'not_int' => _('Article ID is not valid'),
            ]);

        $this->id = $this->data['id'];
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function delete()
    {
        $status = $this->model->delete($this->id);

        if ($status) {
            AlertsCollection::add(new Alert(
                'success',
                'Pomyślnie usunięto artykuł.'
            ));
        }

        return $status;
    }
}
