<?php

use Rudolf\Component\Feed\RSS2Item;

class RSS2ItemTest extends \PHPUnit_Framework_TestCase
{
    public function testGetTitle()
    {
        $value = 'test';

        $item = new RSS2Item();
        $item->setTitle($value);

        $this->assertEquals($item->getTitle(), '<title>' . $value . '</title>');
    }

    public function testGetTitleWhenEmpty()
    {
        $item = new RSS2Item();
        $item->setTitle('');

        $this->assertFalse($item->getTitle());
    }

    public function testGetTitleStriped()
    {
        $value = '<s>test</s>';

        $item = new RSS2Item();
        $item->setTitle($value);

        $this->assertEquals($item->getTitle(), '<title>' . strip_tags($value) . '</title>');
    }

    public function testGetLink()
    {
        $value = 'http://example.com/';

        $item = new RSS2Item();
        $item->setLink($value);

        $this->assertEquals($item->getLink(), '<link>' . $value . '</link>');
    }

    public function testGetLlinkWhenEmpty()
    {
        $item = new RSS2Item();
        $item->setLink('');

        $this->assertFalse($item->getLink());
    }
}
