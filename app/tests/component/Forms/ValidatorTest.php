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

    public function testCheckDatetimeExcepctTrue()
    {
        $validator = new Validator();
        $dateToTest = '1970-01-01 00:00:00';

        $this->assertTrue($validator->checkDatetime('date', $dateToTest, 'Y-m-d H:i:s'));
    }

    public function testCheckDatetimeNotValid()
    {
        $validator = new Validator();
        $dateToTest = '1970-01-01 00-00-00';

        $this->assertFalse($validator->checkDatetime('date', $dateToTest, 'Y-m-d H:i:s'));
    }

    public function testCheckDatetimeNotValidAlert()
    {
        $validator = new Validator();
        $dateToTest = '1970-01-01 00-00-00';
        $validator->checkDatetime('date', $dateToTest, 'Y-m-d H:i:s');

        $this->assertEquals($validator->getAlerts()['date'], [
            'type' => 'error',
            'message' => 'Invalid datetime',
        ]);
    }

    public function testCheckChar()
    {
        $validator = new Validator();
        $charToTest = 'validator';

        $this->assertTrue($validator->checkChar('char', $charToTest, 9, 0));
    }

    public function testCheckCharToShort()
    {
        $validator = new Validator();
        $charToTest = 'validator';

        $this->assertFalse($validator->checkChar('char', $charToTest, 90, 10));
    }

    public function testCheckCharToShortAlert()
    {
        $validator = new Validator();
        $charToTest = 'validator';
        $validator->checkChar('char', $charToTest, 90, 10);

        $this->assertEquals($validator->getAlerts()['char'], [
            'type' => 'error',
            'message' => 'Too short string',
        ]);
    }

    public function testCheckCharToLongAlert()
    {
        $validator = new Validator();
        $charToTest = 'validator';
        $validator->checkChar('char', $charToTest, 1, 0);

        $this->assertEquals($validator->getAlerts()['char'], [
            'type' => 'error',
            'message' => 'Too long string',
        ]);
    }

    public function testCheckInt()
    {
        $validator = new Validator();
        $intTotest = 128;

        $this->assertTrue($validator->checkInt('int', $intTotest, 129, 0));
    }

    public function testCheckIntBeyondUpperRange()
    {
        $validator = new Validator();
        $intTotest = 1024;

        $this->assertFalse($validator->checkInt('int', $intTotest, 129));
    }

    public function testCheckIntBeyondLowerRange()
    {
        $validator = new Validator();
        $intTotest = 1024;

        $this->assertFalse($validator->checkInt('int', $intTotest, false, 2048));
    }
}
