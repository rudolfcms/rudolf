<?php

use Rudolf\Component\Forms\AdminFields;

class AdminFieldsTest extends \PHPUnit_Framework_TestCase
{
    public function testTextarea()
    {
        $form = new AdminFields();

        $this->assertEquals(
            '<textarea name="name" class="class" id="id" placeholder="" cols="30" rows="10">lorem ipsum</textarea>',
            $form->textarea('lorem ipsum', 'name', 'class', 'id')
        );
    }

    public function testDatetimeInput()
    {
        $form = new AdminFields();

        $this->assertEquals(
            '<input type="datetime" value="2016-06-27" name="name" class="class" id="id" placeholder="">',
            $form->datetimeInput('2016-06-27', 'name', 'class', 'id')
        );
    }

    public function testPathInput()
    {
        $form = new AdminFields();

        $this->assertEquals(
            '<input type="text" value="path" name="name" class="class" id="id" placeholder="">',
            $form->pathInput('path', 'name', 'class', 'id')
        );
    }
}
