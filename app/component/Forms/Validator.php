<?php

namespace Rudolf\Component\Forms;

use DateTime;

class Validator
{
    /**
     * @var array Alerts
     */
    private $alerts;

    /**
     * @var array Fileds in form
     */
    private $fields;

    /**
     * Checks if there are any errors.
     * 
     * @return false
     */
    public function isErrors()
    {
        foreach ($this->fields as $key => $value) {
            if (0 === $value) {
                return true;
            }
        }

        return false;
    }

    /**
     * Returns array with alerts.
     * 
     * @return false|array
     */
    public function getAlerts()
    {
        return (empty($this->alerts)) ? false : $this->alerts;
    }

    /**
     * Checks wheter date is valid.
     * 
     * @param string $field  Field name
     * @param string $value  Field value
     * @param string $format Date format
     * 
     * @return bool
     */
    public function checkDatetime($field, $value, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $value);

        if (false === ($d && $d->format($format) == $value)) {
            $this->alerts[$field] = [
                'type' => 'error',
                'message' => 'Invalid datetime',
            ];

            $this->fields[$field] = 0;

            return false;
        }

        $this->fields[$field] = 1;

        return true;
    }

    /**
     * Check char.
     * 
     * @param string $field Field name
     * @param string $value Field value
     * @param int    $max   Max characters in string
     * @param int    $min   Min characters
     * 
     * @return bool
     */
    public function checkChar($field, $value, $max = 255, $min = 0)
    {
        $length = strlen($value);

        if ($length < $min) {
            $this->alerts[$field] = [
                'type' => 'error',
                'message' => 'Too short string',
            ];

            $this->fields[$field] = 0;

            return false;
        } elseif ($max < $length) {
            $this->alerts[$field] = [
                'type' => 'error',
                'message' => 'Too long string',
            ];

            $this->fields[$field] = 0;

            return false;
        }

        $this->fields[$field] = 1;

        return true;
    }

    /**
     * Check int.
     * 
     * @param string $field Field name
     * @param int    $field Field value
     * @param int    $max   Max value
     * @param int    $min   Min value
     * @param bool
     */
    public function checkInt($field, $value, $max = false, $min = 0)
    {
        if ($value < $min) {
            $this->alerts[$field] = [
                'type' => 'error',
                'message' => 'Too low',
            ];

            $this->fields[$field] = 0;

            return false;
        } elseif ($value > $max) {
            $this->alerts[$field] = [
                'type' => 'error',
                'message' => 'Too high',
            ];

            $this->fields[$field] = 0;

            return false;
        }

        $this->fields[$field] = 1;

        return true;
    }
}
