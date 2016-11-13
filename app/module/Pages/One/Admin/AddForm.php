<?php

namespace Rudolf\Modules\Pages\One\Admin;

use Rudolf\Component\Alerts\Alert;
use Rudolf\Component\Alerts\AlertsCollection;
use Rudolf\Modules\Pages\One\Admin\Page;
use Rudolf\Modules\Pages\One\Model as PageOne;
use Rudolf\Modules\Pages\Roll\Model as PagesList;

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
            $this->dataValidated['id'] = $status;
            $page = new PageOne();
            $pagesList = new PagesList();
            $data = $page->addToPageUrl(
                $this->dataValidated,
                $pagesList->getPagesList()
            );
            $page = new Page($data);

            AlertsCollection::add(new Alert(
                'success', 'Pomyślnie dodano stronę.
                <a href="'.$page->url().'">Zobacz ją</a>.'
            ));
        }

        return $status;
    }
}
