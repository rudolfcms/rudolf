<?php

namespace Rudolf\Modules\Albums\One;

use Rudolf\Component\Hooks;
use Rudolf\Component\Html\Text;
use Rudolf\Component\Images\Image;

class Album
{
    /**
     * @var array Albums data
     */
    protected $album;

    /**
     * Constructor.
     * 
     * @param array $album
     */
    public function __construct($album = [])
    {
        $this->setData($album);
    }

    /**
     * Set album data.
     * 
     * @param array $album
     */
    public function setData($album)
    {
        $this->album = array_merge(
            [
                'id' => 0,
                'category_ID' => 0,
                'title' => '',
                'author' => '',
                'date' => '',
                'added' => '',
                'modified' => '',
                'adder_ID' => 0,
                'adder_first_name' => '',
                'adder_surname' => '',
                'modifier_ID' => 0,
                'modifier_first_name' => '',
                'modifier_surname' => '',
                'views' => 0,
                'slug' => '',
                'album' => '',
                'thumb' => '',
                'photos' => 0,
                'published' => false,
                'category_title' => '',
                'category_url' => '',
            ],
            (array) $album
        );

        return $this->album;
    }

    /**
     * Returns album ID.
     * 
     * @return int
     */
    public function id()
    {
        return (int) $this->album['id'];
    }

    /**
     * Returns category ID.
     * 
     * @return int
     */
    public function categoryID()
    {
        return (int) $this->album['category_ID'];
    }

    /**
     * Returns album title.
     * 
     * @param string $type null|raw
     * 
     * @return string
     */
    public function title($type = '')
    {
        $title = $this->album['title'];
        if ('raw' === $type) {
            return $title;
        }

        return Text::escape($title);
    }

    /**
     * Returns the author.
     * 
     * @param string $type null|raw
     * 
     * @return string
     */
    public function author($type = '', $adder = true)
    {
        $author = $this->album['author'];

        // if fields is empty and $adder is true
        if (empty($author) and true === $adder) {
            $author = $this->adderFullName(false);
        }

        if ('raw' === $type) {
            return $author;
        }

        return Text::escape($author);
    }

    /**
     * Returns album date.
     * 
     * @param bool|string $format
     * @param string      $style  normal|locale
     * 
     * @return string If date field empty, return current date
     */
    public function date($format = false, $style = 'normal', $inflected = true)
    {
        $date = $this->album['date'];

        if (empty($date)) {
            $date = date('Y-m-d H:i:s');
        }

        switch ($style) {
            case 'locale': // http://php.net/manual/en/function.strftime.php
                $format = ($format) ? $format : '%D';
                $date = strftime($format, strtotime($date));
                break;

            default: // http://php.net/manual/en/datetime.formats.date.php
                $format = ($format) ? $format : 'Y-m-d H:i:s';
                $date = date_format(date_create($date), $format);
                break;
        }

        $date = Hooks\Filter::apply('date_format_filter', $date);

        if (true === $inflected) {
            $month = [
                'styczeń' => 'stycznia', // 01
                'luty' => 'lutego', // 02
                'marzec' => 'marca', // 03
                'kwiecień' => 'kwietnia', // 04
                'maj' => 'maja', // 05
                'czerwiec' => 'czerwca', // 06
                'lipiec' => 'lipca', // 07
                'sierpień' => 'sierpnia', // 08
                'wrzesień' => 'września', // 09
                'październik' => 'października', // 10
                'listopad' => 'listopada', // 11
                'grudzień' => 'grudnia', // 12
            ];

            foreach ($month as $key => $value) {
                $date = str_replace($key, $value, $date);
            }
        }

        return $date;
    }

    /**
     * Returns date of album added.
     * 
     * @return string
     */
    public function added()
    {
        return $this->album['added'];
    }

    /**
     * Returns date of last album modified.
     * 
     * @return string
     */
    public function modified()
    {
        return $this->album['modified'];
    }

    /**
     * Returns adder ID.
     * 
     * @return int
     */
    public function adderID()
    {
        return (int) $this->album['adder_ID'];
    }

    /**
     * Returns first name and surname of adder.
     * 
     * @param string $type
     * 
     * @return string
     */
    public function adderFullName($type = '')
    {
        $name = trim($this->album['adder_first_name'].' '.$this->album['adder_surname']);
        if ('raw' === $type) {
            return $name;
        }

        return Text::escape($name);
    }

    /**
     * Returns modifier ID.
     * 
     * @return int
     */
    public function modifierID()
    {
        return (int) $this->album['modifier_ID'];
    }

    /**
     * Returns modifier full name.
     * 
     * @return int
     */
    public function modifierFullName($type = '')
    {
        $name = $this->album['modifier_first_name'].' '.$this->album['modifier_surname'];
        if ('raw' === $type) {
            return $name;
        }

        return Text::escape($name);
    }

    /**
     * Checks whether the album has modified.
     * 
     * @return bool
     */
    public function isModified()
    {
        return (bool) $this->album['modified'];
    }

    /**
     * Returns the number of views.
     * 
     * @return int
     */
    public function views()
    {
        return (int) $this->album['views'];
    }

    /**
     * Returns album slug.
     * 
     * @return string
     */
    public function slug()
    {
        return Text::escape($this->album['slug']);
    }

    /**
     * Returns album url.
     * 
     * @return string
     */
    public function url()
    {
        return sprintf('%1$s/%2$s/%3$s/%4$s/%5$s',
            DIR,
            'foto',
            $this->date('Y'),
            $this->date('m'),
            $this->slug()
        );
    }

    /**
     * Returns album path.
     * 
     * @return string
     */
    public function album()
    {
        return Text::escape($this->album['album']);
    }

    /**
     * Returns thumb path.
     * 
     * @return string
     */
    public function thumb()
    {
        return Text::escape($this->album['thumb']);
    }

    /**
     * Checks whether the album has a thumbnail.
     * 
     * @return bool
     */
    public function hasThumbnail()
    {
        return (bool) $this->album['thumb'];
    }

    /**
     * Returns thumbnail code or only address.
     * 
     * @param int    $width   Image width
     * @param int    $height  Image height
     * @param bool   $album   Add album address if exists
     * @param string $alt     Set alternative text
     * @param string $default Default thumb path. It use when thumb path is empty
     * 
     * @return string
     */
    public function thumbnail($width = 100, $height = 100, $album = false, $alt = '', $default = '')
    {
        $path = $this->thumb();
        $alt = ($alt) ? $alt : $this->title('raw');

        if (!$this->hasThumbnail()) {
            if (!empty($default)) {
                $path = $default;
            } else {
                return false;
            }
        }

        $path = Image::resize($path, $width, $height);

        $image = sprintf('<img src="%1$s" alt="%4$s" width="%2$s" height="%3$s">',
            $path, $width, $height, $alt
        );

        if (true === $album and !empty($this->album())) {
            $album = $this->album();
            $image = sprintf('<a href="%1$s">%2$s</a>', $album, $image);
        }

        return $image;
    }

    /**
     * Returns the number of photos.
     * 
     * @return int
     */
    public function photos()
    {
        return (int) $this->album['photos'];
    }

    /**
     * Checks whether the album has a photos.
     * 
     * @return bool
     */
    public function hasPhotos()
    {
        return (bool) $this->album['photos'];
    }

    /**
     * Chcecks whether the album is published.
     * 
     * @return bool
     */
    public function isPublished()
    {
        return (bool) $this->album['published'];
    }

    /**
     * Returns album category anchor.
     * 
     * @return string
     */
    public function category()
    {
        return sprintf('<a href="%1$s">%2$s</a>',
            $this->categoryUrl(),
            $this->categoryTitle()
        );
    }

    /**
     * Returns category title.
     * 
     * @param string $type
     * 
     * @return string
     */
    public function categoryTitle($type = '')
    {
        $title = $this->album['category_title'];

        if ('raw' === $type) {
            return $title;
        }

        return Text::escape($title);
    }

    /**
     * Returns category url.
     * 
     * @return string
     */
    public function categoryUrl()
    {
        return sprintf('%1$s/%2$s/%3$s',
            DIR,
            'foto/kategorie',
            Text::escape($this->album['category_url'])
        );
    }

    /**
     * Checks whether the album has a category.
     * 
     * @return bool
     */
    public function hasCategory()
    {
        return (bool) $this->album['category_url'];
    }
}
