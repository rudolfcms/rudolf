<?php

namespace Rudolf\Modules\Articles\One\Admin;

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
        return $this->model->add($this->dataValidated);
    }
}