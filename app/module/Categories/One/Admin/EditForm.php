<?php

namespace Rudolf\Modules\Categories\One\Admin;

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
        return $this->model->update($this->dataValidated);
    }
}
