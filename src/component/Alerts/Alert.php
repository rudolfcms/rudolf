<?php

namespace Rudolf\Component\Alerts;

class Alert implements IAlert
{
    const MODE_IMMEDIATELY = 0;

    const MODE_SESSION = 1;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $message;

    /**
     * Constructor.
     *
     * @param string $type
     * @param string $message
     */
    public function __construct($type, $message, $mode = self::MODE_SESSION)
    {
        $this->setType($type);
        $this->setMessage($message);

        if (self::MODE_SESSION === $mode) {
            $_SESSION['rudolf_alerts'][md5($message)] = [
                'type' => $type,
                'message' => $message,
            ];
        }
    }

    /**
     * Set alert type.
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
     * Get alert type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set alert mesage.
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
     * Get alert mesage.
     *
     * @return string
     */
    public function getMessage()
    {
        unset($_SESSION['rudolf_alerts'][md5($this->message)]);

        return $this->message;
    }
}
