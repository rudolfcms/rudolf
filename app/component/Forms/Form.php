<?php

namespace Rudolf\Component\Forms;

use Rudolf\Component\Alerts;

abstract class Form
{
    /**
     * @var array
     */
    protected $data;

    /**
     * @var array
     */
    protected $fields;

    public function __construct()
    {
        $this->validator = new Validator();
    }

    /**
     * Request handler.
     *
     * @param array $request Request array ($_POST)
     */
    public function handle(array $request)
    {
        $this->data = $request;

        $this->check();
    }

    /**
     * Chech is any errors.
     *
     * @return bool
     */
    public function isValid()
    {
        return !$this->validator->isErrors();
    }

    /**
     * Check is fields values valid.
     */
    abstract protected function check();

    /**
     * Get data to display in add form.
     *
     * @param array $mergeWith
     *
     * @return array
     */
    public function getDataToDisplay($mergeWith = [])
    {
        if (empty($this->data)) {
            $this->data = [];
        }
        if (!empty($mergeWith)) {
            $this->data = array_merge($mergeWith, $this->data);
        }

        return array_map(function ($a) {
            return htmlspecialchars(trim($a));
        }, $this->data);
    }

    public function dispalyAlerts()
    {
        foreach ($this->validator->getAlerts() as $key => $value) {
            Alerts\AlertsCollection::add(new Alerts\Alert(
                'danger', $value
            ));
        }
    }
}
