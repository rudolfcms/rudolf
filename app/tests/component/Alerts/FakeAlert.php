<?php

namespace Rudolf\Tests\component\Alerts;

class FakeAlert
{
    public function __construct($type, $message)
    {
        $this->type = $type;
        $this->message = $message;
    }
}
