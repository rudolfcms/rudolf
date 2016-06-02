<?php
namespace Rudolf\Component\Routing;

class Route
{
    /**
     * @var string 
     */
    private $path;

    /**
     * @var string
     */
    private $controllerName;

    /**
     * @var array
     */
    private $params = [];

    /**
     * @var array
     */
    private $defaults = [];

    /**
     * @var int
     */
    private $priority;
    
    /**
     * Constructor
     * 
     * @param string    $path               The path pattern to match
     * @param array     $controllerName     Controller to use for route
     * @param array     $params             Params
     * @param array     $defaults           An array of default parameter values
     * @param int       $priority           Route priority
     */
    public function __construct($path, $controllerName, array $params = [], array $defaults = [], $priority = 1000)
    {
        $this->setPath($path);
        $this->setControllerName($controllerName);
        $this->setParams($params);
        $this->setDefaults($defaults);
        $this->setPriority($priority);
    }

    /**
     * Sets the pattern for the path
     * 
     * @access private
     *
     * @param string $pattern The path pattern
     */
    private function setPath($path)
    {
        $this->path = '/' . ltrim(trim($path), '/');
    }

    /**
     * Returns the path
     * 
     * @access public
     * 
     * @return string $path
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Sets the controller name to use for route
     * 
     * @access private
     * 
     * @param string $controllerName The controller name
     */
    private function setControllerName($controllerName)
    {
        $this->controllerName = $controllerName;
    }

    /**
     * Returns the controller name
     * 
     * @access public
     * 
     * @return array $controllerName 
     */
    public function getControllerName()
    {
        return $this->controllerName;
    }

    /**
     * Sets the params
     * 
     * @access private
     * 
     * @param array $params The params
     */
    private function setParams($params)
    {
        $this->params = $params;
    }

    /**
     * Returns the params
     * 
     * @access public
     * 
     * @return array $params 
     */
    public function getParams()
    {
        return $this->params;
    }


    /**
     * Returns the priority
     * 
     * @access public
     * 
     * @return array $priority 
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Sets the defaults
     * 
     * @access private
     *
     * @param array $defaults The defaults
     */
    private function setDefaults(array $defaults)
    {
        $this->defaults = $defaults;
    }

    /**
     * Sets the priority
     * 
     * @access private
     *
     * @param int $priority The priority
     */
    private function setPriority($priority)
    {
        $this->priority = $priority;
    }

    /**
     * Returns the defaults params
     * 
     * @access public
     *
     * @return array $defaults The defaults params
     */
    public function getDefaults()
    {
        return $this->defaults;
    }
}
