<?php

namespace Rudolf\Modules\Articles\One\Admin;

use Rudolf\Modules\Articles\One\Article;
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
            $article = new Article($this->dataValidated);
            AlertsCollection::add(new Alert(
                'success', 'Pomyślnie dodano artykuł.
                <a href="'.$article->url().'">Zobacz go</a>.'
            ));
        }

        return $status;
    }
}
