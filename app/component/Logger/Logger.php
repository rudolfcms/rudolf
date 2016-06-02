<?php
namespace Rudolf\Component\Logger;

class Logger
{
    /**
     * Constructor
     */
    public function __construct($logFile = '', $type = '', $message = '', $file = '', $line = '')
    {
        $logFile = ($logFile) ? $logFile : 'errors';
        $this->logPath = LOG_ROOT .'/'. $logFile . '.log';

        $this->setType($type);
        $this->setMessage($message);
        $this->setFile($file);
        $this->setLine($line);
    }

    /**
     * Set exception type
     * 
     * @param string $type
     * 
     * @return void
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Set message
     * 
     * @param string $message
     * 
     * @return void
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * Set file in which occurred exception 
     * 
     * @param string $file
     * 
     * @return void
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    /**
     * Set a line in the file, where exception occurred
     * 
     * @param int $line
     * 
     * @return void
     */
    public function setLine($line)
    {
        $this->line = $line;
    }

    /**
     * Save event to file
     * 
     * @return bool
     */
    public function save()
    {
        $this->event = sprintf('[%1$s] %2$s: %3$s in [%4$s] on line %5$s (%6$s)',
            date('Y-m-d H:i:s'),
            $this->type,
            $this->message,
            $this->file,
            $this->line,
            $_SERVER['REQUEST_URI']
        );
        
        // if debug, not save event to file
        if (true === ENV) {
            $this->display();
        } else {
            $save = file_put_contents($this->logPath, $this->event . PHP_EOL, FILE_APPEND | LOCK_EX);
            return $save;
        }
    }

    /**
     * Print message
     * 
     * @return void
     */
    private function display()
    {
        echo "<code>$this->event</code>" . PHP_EOL;
    }
}
