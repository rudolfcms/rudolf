<?php

use Rudolf\Modules\Albums\One\Album;

class AlbumTest extends \PHPUnit_Framework_TestCase
{
    public function testSetData()
    {
        $obj = new Album();
        $data = $this->getAlbumData();
        $this->assertEquals($obj->setData($data), $data);
    }

    public function testID()
    {
        $id = 2345;

        $obj = new Album();
        $obj->setData(['id' => $id]);
        $this->assertEquals($obj->id(), $id);
    }

    public function testCategoryID()
    {
        $categoryID = 3245;

        $obj = new Album();
        $obj->setData(['category_ID' => $categoryID]);
        $this->assertEquals($obj->categoryID(), $categoryID);
    }

    public function testTitle()
    {
        $title = 'Album test & test';

        $obj = new Album();
        $obj->setData(['title' => $title]);
        $this->assertEquals($obj->title(), htmlspecialchars($title)); // &lt;Testing album&gt;
    }

    public function testRawTitle()
    {
        $title = 'Album test & test';

        $obj = new Album();
        $obj->setData(['title' => $title]);
        $this->assertEquals($obj->title('raw'), $title);
    }

    public function testAuthor()
    {
        $author = '<Testing author>';

        $obj = new Album();
        $obj->setData(['author' => $author]);
        $this->assertEquals($obj->author(), htmlspecialchars($author)); // &lt;Testing author&gt;
    }

    public function testRawAuthor()
    {
        $author = '<Testing author>';

        $obj = new Album();
        $obj->setData(['author' => $author]);
        $this->assertEquals($obj->author('raw'), $author); // <Testing author>
    }

    public function testDate()
    {
        $date = '2016-07-20 16:16:32';

        $obj = new Album();
        $obj->setData(['date' => $date]);
        $this->assertEquals($obj->date(), $date);
    }

    public function testInvalidDate()
    {
        $invalidDate = 'invalid date';

        $obj = new Album();
        $obj->setData(['date' => $invalidDate]);
        $this->assertEquals($obj->date('H:i:s Y-m-d'), $invalidDate);
    }

    public function testDateNormalFormat()
    {
        $date = '2016-07-20 16:16:32';
        $style = 'normal';

        $format = 'H:i:s Y-m-d';
        $date = date_format(date_create($date), $format);

        $obj = new Album();
        $obj->setData(['date' => $date]);
        $this->assertEquals($obj->date($format, $style), $date);
    }

    public function testDateLocaleFormat()
    {
        $date = '2016-07-20 16:16:32';
        $style = 'locale';

        $format = '%D';
        $date = strftime($format, strtotime($date));

        $obj = new Album();
        $obj->setData(['date' => $date]);
        $this->assertEquals($obj->date($format, $style), $date);
    }

    public function testAdded()
    {
        $added = '2016-07-20 16:00:16';

        $obj = new Album();
        $obj->setData(['added' => $added]);
        $this->assertEquals($obj->added(), $added);
    }

    public function testModified()
    {
        $modified = '2016-07-20 17:00:17';

        $obj = new Album();
        $obj->setData(['modified' => $modified]);
        $this->assertEquals($obj->modified(), $modified);
    }

    public function testAdderID()
    {
        $adderID = 2354;

        $obj = new Album();
        $obj->setData(['adder_ID' => $adderID]);
        $this->assertEquals($obj->adderID(), $adderID);
    }

    public function testRawAdderFullName()
    {
        $firstName = '<John>';
        $surname = '<Cafe>';

        $obj = new Album();
        $obj->setData(['adder_first_name' => $firstName, 'adder_surname' => $surname]);
        $this->assertEquals($obj->adderFullName('raw'), $firstName.' '.$surname);
    }

    public function testAdderFullName()
    {
        $firstName = '<John>';
        $surname = '<Cafe>';

        $obj = new Album();
        $obj->setData(['adder_first_name' => $firstName, 'adder_surname' => $surname]);
        $this->assertEquals($obj->adderFullName(), htmlspecialchars($firstName.' '.$surname));
    }

    public function testModifierID()
    {
        $modifierD = 4576;

        $obj = new Album();
        $obj->setData(['modifier_ID' => $modifierD]);
        $this->assertEquals($obj->modifierID(), $modifierD);
    }

    public function testModifierIDType()
    {
        $modifierD = 4576;

        $obj = new Album();
        $obj->setData(['modifier_ID' => $modifierD]);
        $this->assertTrue(is_int($obj->modifierID()));
    }

    public function testRawModifierFullName()
    {
        $firstName = '<George>';
        $surname = '<Wall>';

        $obj = new Album();
        $obj->setData(['modifier_first_name' => $firstName, 'modifier_surname' => $surname]);
        $this->assertEquals($obj->modifierFullName('raw'), $firstName.' '.$surname);
    }

    public function testModifierFullName()
    {
        $firstName = '<George>';
        $surname = '<Wall>';

        $obj = new Album();
        $obj->setData(['modifier_first_name' => $firstName, 'modifier_surname' => $surname]);
        $this->assertEquals($obj->modifierFullName(), htmlspecialchars($firstName.' '.$surname));
    }

    public function testIsModifiedWhenModified()
    {
        $obj = new Album();
        $obj->setData(['modified' => '2016-07-20 17:17:34']);
        $this->assertTrue($obj->isModified());
    }

    public function testIsModifiedWhenNotModified()
    {
        $obj = new Album();
        $this->assertFalse($obj->isModified());
    }

    public function testViews()
    {
        $views = 234;

        $obj = new Album();
        $obj->setData(['views' => $views]);
        $this->assertEquals($obj->views(), $views);
    }

    public function testSlug()
    {
        $slug = 'testing-album';

        $obj = new Album();
        $obj->setData(['slug' => $slug]);
        $this->assertEquals($obj->slug(), $slug);
    }

    public function testUrl()
    {
        $date = '2016-07-20 16:16:32';
        $slug = 'testing-album';

        $obj = new Album();
        $obj->setData(['date' => $date, 'slug' => $slug]);
        $this->assertEquals(
            $obj->url(),
            sprintf(
                '%1$s/%2$s/%3$s/%4$s/%5$s',
                DIR,
                'foto',
                $obj->date('Y'),
                $obj->date('m'),
                $slug
            )
        );
    }

    public function testALbum()
    {
        $album = 'http://albums.rudolf/testing-album';

        $obj = new Album();
        $obj->setData(['album' => $album]);
        $this->assertEquals($obj->album(), $album);
    }

    public function testThumb()
    {
        $thumb = 'http://static.rudolf/thubm/albums/testing-album-250x200';

        $obj = new Album();
        $obj->setData(['thumb' => $thumb]);
        $this->assertEquals($obj->thumb(), $thumb);
    }

    public function testHasThumbnail()
    {
        $thumb = 'http://static.rudolf/thubm/albums/testing-album-250x200';

        $obj = new Album();
        $obj->setData(['thumb' => $thumb]);
        $this->assertTrue($obj->hasThumbnail());
    }

    public function testPhotos()
    {
        $photos = 633;

        $obj = new Album();
        $obj->setData(['photos' => $photos]);
        $this->assertEquals($obj->photos(), $photos);
    }

    public function testHasPhotos()
    {
        $photos = 633;

        $obj = new Album();
        $obj->setData(['photos' => $photos]);
        $this->assertTrue($obj->hasPhotos());
    }

    public function testIsPublished()
    {
        $published = true;

        $obj = new Album();
        $obj->setData(['published' => $published]);
        $this->assertTrue($obj->isPublished());
    }

    private function getAlbumData()
    {
        return [
            'id' => 123,
            'category_ID' => 321,
            'title' => '<Testing album>',
            'author' => 'John&John',
            'date' => '2016-07-20 16:16:32',
            'added' => '2016-07-20 16:00:16',
            'modified' => '2016-07-20 17:17:34',
            'adder_ID' => 5,
            'adder_first_name' => 'John\'s',
            'adder_surname' => 'Smith',
            'modifier_ID' => 15,
            'modifier_first_name' => 'George',
            'modifier_surname' => 'Astley',
            'views' => 1023,
            'slug' => 'testing-album',
            'album' => 'http://albums.rudolf/testing-album',
            'thumb' => 'http://static.rudolf/thubm/albums/testing-album-250x200',
            'photos' => 63,
            'published' => true,
            'category_title' => 'Tests',
            'category_url' => 'tests',
        ];
    }
}
