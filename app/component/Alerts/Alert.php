<?php
namespace Rudolf\Component\Alerts;

class Alert implements IAlert
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $message;

    /**
     * Constructor
     * 
     * @param string $type
     * @param string $message
     */
    public function __construct($type, $message)
    {
        $this->setType($type);
        $this->setMessage($message);
    }

    /**
     * Set alert type
     * 
     * @param string $type
     * 
     * @return string
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Get alert type
     * 
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set alert mesage
     * 
     * @param string $message
     * 
     * @return string
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * Get alert mesage
     * 
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
}
