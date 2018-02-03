<?php

namespace Rudolf\Component\Forms;

use DateTime;

class Validator
{
    /**
     * @var array
     */
    private $alerts;

    /**
     * @var array
     */
    private $errors;

    public function __construct()
    {
        $this->alerts = [];
    }

    /**
     * @return bool
     */
    public function isErrors()
    {
        return !empty($this->alerts);
    }

    /**
     * Returns array with alerts.
     *
     * @return array
     */
    public function getAlerts()
    {
        return $this->alerts;
    }

    /**
     * Check empty field.
     *
     * @param string $field      Field name
     * @param string $value      Field value
     * @param bool   $shouldEmpty
     * @param array  $msg        Custom messages ['empty', 'not_empty']
     *
     * @return $this
     */
    public function checkEmpty($field, $value, $shouldEmpty = false, array $msg = [])
    {
        if (empty($value) && false === $shouldEmpty) {
            $this->alerts[$field] = isset($msg['empty']) ? $msg['empty'] : 'Empty';

            $this->errors[$field] = 1;
        } elseif (!empty($value) && true === $shouldEmpty) {
            $this->alerts[$field] = isset($msg['not_empty']) ? $msg['not_empty'] : 'Not empty';

            $this->errors[$field] = 1;
        } else {
            $this->errors[$field] = 0;
        }

        return $this;
    }

    /**
     * Check char.
     *
     * @param string $field Field name
     * @param string $value Field value
     * @param int    $min   Min characters
     * @param int    $max   Max characters in string
     * @param array  $msg   Custom messages ['short', 'long']
     *
     * @return $this
     */
    public function checkChar($field, $value, $min = 0, $max = 255, array $msg = [])
    {
        $length = strlen(trim($value));

        if ($length < $min) {
            $this->alerts[$field] = isset($msg['short']) ? $msg['short'] : 'Too short';

            $this->errors[$field] = 1;
        } elseif ($max < $length) {
            $this->alerts[$field] = isset($msg['long']) ? $msg['long'] : 'Too long';

            $this->errors[$field] = 1;
        } else {
            $this->errors[$field] = 0;
        }

        return $this;
    }

    /**
     * Check is int
     *
     * @param string $field
     * @param mixed $value
     * @param bool $shouldInt
     * @param array $msg
     *
     * @return $this
     */
    public function checkIsInt($field, $value, $shouldInt = true, array $msg = [])
    {
        $isInt = is_numeric($value);

        if (false === $shouldInt && $isInt) {
            $this->alerts[$field] = isset($msg['int']) ? $msg['int'] : 'Int';

            $this->errors[$field] = 1;
        } elseif (true === $shouldInt && !$isInt) {
            $this->alerts[$field] = isset($msg['not_int']) ? $msg['not_int'] : 'Not int';

            $this->errors[$field] = 1;
        } else {
            $this->errors[$field] = 0;
        }

        return $this;
    }

    /**
     * Check int.
     *
     * @param string    $field Field name
     * @param int       $value Field value
     * @param int       $min   Min value
     * @param int|bool  $max   Max value
     * @param array     $msg   Custom messages ['low', 'high']
     *
     * @return $this
     */
    public function checkInt($field, $value, $min = 0, $max = false, array $msg = [])
    {
        if ($value < $min) {
            $this->alerts[$field] = isset($msg['low']) ? $msg['low'] : 'Too low';

            $this->errors[$field] = 1;
        } elseif ($value > $max) {
            $this->alerts[$field] = isset($msg['high']) ? $msg['high'] : 'Too high';

            $this->errors[$field] = 1;
        } else {
            $this->errors[$field] = 0;
        }

        return $this;
    }

    /**
     * Checks whether data is valid.
     *
     * @param string $field  Field name
     * @param string $value  Field value
     * @param string $format Date format
     * @param array  $msg    Custom messages ['invalid']
     *
     * @return $this
     */
    public function checkDatetime($field, $value, $format = 'Y-m-d', array $msg = [])
    {
        $d = DateTime::createFromFormat($format, $value);

        if (false === ($d && $d->format($format) === $value)) {
            $this->alerts[$field] = isset($msg['invalid']) ? $msg['invalid'] : 'Invalid datetime';
            $this->errors[$field] = 1;
        } else {
            $this->errors[$field] = 0;
        }

        return $this;
    }
}
