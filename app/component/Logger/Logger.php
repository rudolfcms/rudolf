<?php
namespace Rudolf\Component\Logger;

use Psr\Log\AbstractLogger;

class Logger extends AbstractLogger
{
    public function log($level, $message, array $context = [])
    {
        file_put_contents(LOG_ROOT .'/'. $level .'.log', $this->format($message), FILE_APPEND | LOCK_EX);
    }

    private function format($message)
    {
        return sprintf("[%s] %s | %s\n",
            date('Y-m-d H:i:s'),
            $message,
            $_SERVER['REQUEST_URI']
        );
    }
}
