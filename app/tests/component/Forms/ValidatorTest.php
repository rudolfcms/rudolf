<?php

use Rudolf\Component\Forms\Validator;

class ValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testIsErrorsWhenNotErrors()
    {
        $validator = new Validator();
        $dateToTest = '1970-01-01 00:00:00';
        $validator->checkDatetime('date', $dateToTest, 'Y-m-d H:i:s');

        $this->assertFalse($validator->isErrors());
    }

    public function testIsErrorsWhenErrors()
    {
        $validator = new Validator();
        $dateToTest = '1970-01-01 00-00-00';
        $validator->checkDatetime('date', $dateToTest, 'Y-m-d H:i:s');

        $this->assertTrue($validator->isErrors());
    }

    public function testCheckDatetimeValid()
    {
        $validator = new Validator();
        $validator->checkDatetime('date', '1970-01-01 00:00:00', 'Y-m-d H:i:s');

        $this->assertFalse($validator->isErrors());
    }

    public function testCheckDatetimeNotValid()
    {
        $validator = new Validator();
        $validator->checkDatetime('date', '1970-01-01 00-00-00', 'Y-m-d H:i:s');

        $this->assertTrue($validator->isErrors());
    }

    public function testCheckChar()
    {
        $validator = new Validator();
        $validator->checkChar('char', 'validator', 8);

        $this->assertFalse($validator->isErrors());
    }

    public function testCheckCharToShort()
    {
        $validator = new Validator();
        $validator->checkChar('char', 'validator', 10);

        $this->assertTrue($validator->isErrors());
    }

    public function testCheckInt()
    {
        $validator = new Validator();
        $validator->checkInt('int', 128, 129, 0);

        $this->assertTrue($validator->isErrors());
    }

    public function testCheckIntBeyondUpperRange()
    {
        $validator = new Validator();
        $validator->checkInt('int', 1024, $min = 0, $max = 129);

        $this->assertTrue($validator->isErrors());
    }

    public function testCheckIntBeyondLowerRange()
    {
        $validator = new Validator();
        $validator->checkInt('int', 1024, $min = 2048);

        $this->assertTrue($validator->isErrors());
    }
}
