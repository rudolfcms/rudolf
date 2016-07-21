<?php

use Rudolf\Component\Helpers\Pagination\Calc;
use Rudolf\Component\Helpers\Pagination\Loop;

class LoopTest extends \PHPUnit_Framework_TestCase
{
    private $data = [
        [
            'title' => 'test',
            'slug' => 'test',
        ],
        [
            'title' => 'test1',
            'slug' => 'test1',
        ],
    ];

    public function testTotal()
    {
        $data = $this->data;
        $calc = new Calc(count($data), 1);
        $loop = new Loop($data, $calc);

        $this->assertEquals($loop->total(), count($data));
    }

    public function testIsItemsWhenItemsExists()
    {
        $data = $this->data;
        $calc = new Calc(count($data), 1);
        $loop = new Loop($data, $calc);

        $this->assertTrue($loop->isItems());
    }

    public function testIsItemsWhenArrayItemsEmpty()
    {
        $data = [];
        $calc = new Calc(count($data), 1);
        $loop = new Loop($data, $calc);

        $this->assertFalse($loop->isItems());
    }

    public function testIsItemsWhenArrayItemsNotArray()
    {
        $data = false;
        $calc = new Calc(count($data), 1);
        $loop = new Loop($data, $calc);

        $this->assertFalse($loop->isItems());
    }

    public function testHaveItemsWhenItemsExists()
    {
        $data = $this->data;
        $calc = new Calc(count($data), 1);
        $loop = new Loop($data, $calc);

        $this->assertTrue($loop->haveItems());
    }

    public function testHaveItemsWhenItemsNotExists()
    {
        $data = [];
        $calc = new Calc(count($data), 1);
        $loop = new Loop($data, $calc);

        $this->assertFalse($loop->haveItems());
    }

    public function testItem()
    {
        $data = $this->data;
        $calc = new Calc(count($data), 1);
        $loop = new Loop($data, $calc);
        $loop->haveItems();

        $this->assertInstanceOf('Rudolf\Component\Helpers\Pagination\IItem', $loop->item());
    }

    public function testNav()
    {
        $data = $this->data;
        $calc = new Calc(count($data), 1);
        $loop = new Loop($data, $calc);

        $s = "<ul class=\"nav\">\n\t<li class=\"current\"><a href=\"/page/1\">1</a></li>\n</ul>\n";
        $this->assertEquals($s, $loop->nav(['ul' => 'nav'], 0));
    }

    public function testIsPaginationWhenExistOnePage()
    {
        $data = $this->data;
        $calc = new Calc(count($data), 1);
        $loop = new Loop($data, $calc);

        $this->assertFalse($loop->isPagination());
    }

    public function testIsPaginationWhenExistTwoPage()
    {
        $data = $this->data;
        $calc = new Calc(count($data), 1, 1); // two items, on per page
        $loop = new Loop($data, $calc);

        $this->assertTrue($loop->isPagination());
    }
}
