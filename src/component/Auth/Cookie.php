<?php

namespace Rudolf\Component\Auth;

class Cookie
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $value;

    /**
     * @var string
     */
    private $expire;

    /**
     * @var string
     */
    private $path;

    /**
     * Constructor.
     *
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Create cookie.
     *
     * @return bool
     */
    public function create()
    {
        return setcookie($this->name, $this->value, $this->expire, $this->path);
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return (isset($_COOKIE[$this->name])) ? $_COOKIE[$this->name] : '';
    }

    /**
     * @return bool
     */
    public function isExist()
    {
        return (bool) (isset($_COOKIE[$this->name]));
    }

    /**
     * Destroy cookie.
     */
    public function destroy()
    {
        if (empty($this->path)) {
            $this->path = DIR;
        }

        setcookie($this->name, '', time() - 3600, $this->path);
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @param string $expire
     */
    public function setExpire($expire)
    {
        $this->expire = $expire;
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }
}
