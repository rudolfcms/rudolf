<?php
namespace Rudolf\Tests\Component\Alerts;

class FakeAlert
{
    public function __construct($type, $message)
    {
        $this->type = $type;
        $this->message = $message;
    }
}
