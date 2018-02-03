<?php

namespace Rudolf\Modules\Articles\One\Admin;

use Rudolf\Modules\Articles\One\Article;
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
     * @throws \Exception
     */
    public function update()
    {
        $status = $this->model->update($this->dataValidated);

        if ($status) {
            $article = new Article($this->dataValidated);
            AlertsCollection::add(new Alert(
                'success',
                'Pomyślnie zmodyfikowano artykuł.
                <a href="'.$article->url().'">Zobacz go</a>.'
            ));
        }

        return $status;
    }
}
