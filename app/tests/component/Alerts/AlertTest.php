<?php

use Rudolf\Component\Alerts\Alert;

class AlertTest extends \PHPUnit_Framework_TestCase
{
    public function testGetType()
    {
        $type = 'success';

        $alert = new Alert($type, 'Yea! All success');

        $this->assertEquals($alert->getType(), $type);
    }

    public function testGetMessage()
    {
        $message = 'Yea! All success';

        $alert = new Alert('success', $message);

        $this->assertEquals($alert->getMessage(), $message);
    }
}
