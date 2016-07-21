<?php

namespace Rudolf\Component\ErrorHandler\Handler;

interface IHandler
{
    public function handle($exception);
}
