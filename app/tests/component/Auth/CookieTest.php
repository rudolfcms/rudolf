<?php

use Rudolf\Component\Auth\Cookie;

class CookieTest extends \PHPUnit_Framework_TestCase
{
    private $cookieName = 'cookiemonster';
    private $cookieValue = 'cookies';

    /**
     * @runInSeparateProcess
     */
    public function testCreate()
    {
        $cookie = new Cookie($this->cookieName);
        $cookie->setValue($this->cookieValue);
        $cookie->setExpire('1');
        $cookie->setPath('/');
        $cookie->create();

        $this->assertTrue($cookie->create(), 'Must return true!');
    }

    /**
     * @runInSeparateProcess
     */
    public function testGetValue()
    {
        $cookie = new Cookie($this->cookieName);
        $cookie->setValue($this->cookieValue);
        $cookie->setExpire('1');
        $cookie->setPath('/');
        $cookie->create();
        $_COOKIE[$this->cookieName] = $this->cookieValue;

        $this->assertEquals($cookie->getValue(), $this->cookieValue);
    }

    /**
     * @runInSeparateProcess
     */
    public function testIsExistWhenCookieExist()
    {
        $cookie = new Cookie($this->cookieName);
        $cookie->setValue($this->cookieValue);
        $cookie->setExpire('1');
        $cookie->setPath('/');
        $cookie->create();
        $_COOKIE[$this->cookieName] = $this->cookieValue;

        $this->assertTrue($cookie->isExist());
    }

    public function testIsExistWhenCookieNotExist()
    {
        $cookie = new Cookie($this->cookieName);
        $cookie->setValue($this->cookieValue);
        $cookie->setExpire('1');
        $cookie->setPath('/');

        $this->assertFalse($cookie->isExist());
    }
}
