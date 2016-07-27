<?php

namespace Rudolf\Modules\Articles\One\Admin;

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
