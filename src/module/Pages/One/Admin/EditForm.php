<?php

namespace Rudolf\Modules\Pages\One\Admin;

use Rudolf\Component\Alerts\Alert;
use Rudolf\Component\Alerts\AlertsCollection;
use Rudolf\Modules\Pages\One\Model as PageOne;
use Rudolf\Modules\Pages\Roll\Model as PagesList;

class EditForm extends FormCheck
{
    /**
     * @var EditModel
     */
    protected $model;

    /**
     * @param EditModel $model
     */
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
            $page = new PageOne();
            $pagesList = new PagesList();
            $data = $page->addToPageUrl(
                $this->dataValidated,
                $pagesList->getPagesList()
            );
            $page = new Page($data);

            AlertsCollection::add(new Alert(
                'success',
                'Pomyślnie zmodyfikowano stronę.
                <a href="'.$page->url().'">Zobacz ją</a>.'
            ));
        }

        return $status;
    }
}
