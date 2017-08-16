<?php

namespace Rudolf\Component\Logger;

use Psr\Log\AbstractLogger;

class Logger extends AbstractLogger
{
    /**
     * @param string $level
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function log($level, $message, array $context = [])
    {
        file_put_contents(LOG_ROOT.'/'.$level.'.log', $this->format($message), FILE_APPEND | LOCK_EX);
    }

    /**
     * @param string $message
     *
     * @return string
     */
    private function format($message)
    {
        $request = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI']: '';

        return sprintf(
            "[%s] %s | %s\n",
            date('Y-m-d H:i:s'),
            $message,
            $request
        );
    }
}
