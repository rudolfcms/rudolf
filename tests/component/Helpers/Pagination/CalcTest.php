<?php

use Rudolf\Component\Helpers\Pagination\Calc;

class CalcTest extends \PHPUnit_Framework_TestCase
{
    private $total = 64;
    private $pageNumber = 1;
    private $onPage = 8;
    private $navNum = 6;

    /**
     * @expectedException InvalidArgumentException
     */
    public function testConstructorWithMinusTotal()
    {
        new Calc(-$this->total, $this->pageNumber, $this->onPage, $this->navNum);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testConstructorWithMinusPageNumber()
    {
        new Calc($this->total, -$this->pageNumber, $this->onPage, $this->navNum);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testConstructorWithMinusOnPage()
    {
        new Calc($this->total, $this->pageNumber, -$this->onPage, $this->navNum);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testConstructorWithMinusNavNum()
    {
        new Calc($this->total, $this->pageNumber, $this->onPage, -$this->navNum);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testConstructorWithMinusParams()
    {
        new Calc(-$this->total, -$this->pageNumber, -$this->onPage, -$this->navNum);
    }

    public function testGetTotal()
    {
        $calc = new Calc($this->total);

        $this->assertEquals($this->total, $calc->getTotal());
    }

    public function testGetOnPage()
    {
        $calc = new Calc($this->total, $this->pageNumber, $this->onPage);

        $this->assertEquals($this->onPage, $calc->getOnPage());
    }

    public function testGetNavNum()
    {
        $calc = new Calc($this->total, $this->pageNumber, $this->onPage, $this->navNum);

        $this->assertEquals($this->navNum, $calc->getNavNum());
    }
}
