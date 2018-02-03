<?php

namespace Rudolf\Modules\Galleries\One;

use Rudolf\Component\Html\Text;

class Gallery
{
    /**
     * @var array Article data
     */
    protected $gallery;

    /**
     * @var array
     */
    protected $images;

    /**
     * Constructor.
     *
     * @param array $gallery
     */
    public function __construct(array $gallery = [])
    {
        $this->setData($gallery);
    }

    /**
     * Set gallery data.
     *
     * @param array $gallery
     */
    public function setData($gallery)
    {
        $this->gallery = array_merge(
            [
                'id' => 0,
                'title' => '',
                'thumb_width' => '',
                'thumb_height' => '',
                'added' => '',
                'modified' => '',
                'adder_ID' => 0,
                'adder_first_name' => '',
                'adder_surname' => '',
                'modifier_ID' => 0,
                'modifier_first_name' => '',
                'modifier_surname' => '',
                'slug' => '',
            ],
            (array) $gallery
        );
    }

    /**
     * Returns gallery ID.
     *
     * @return int
     */
    public function id()
    {
        return (int) $this->gallery['id'];
    }

    /**
     * Returns gallery title.
     *
     * @param string $type null|raw
     *
     * @return string
     */
    public function title($type = '')
    {
        $title = $this->gallery['title'];
        if ('raw' === $type) {
            return $title;
        }

        return Text::escape($title);
    }

    /**
     * Returns date of gallery added.
     *
     * @return string
     */
    public function added()
    {
        return $this->gallery['added'];
    }

    /**
     * Returns date of last gallery modified.
     *
     * @return string
     */
    public function modified()
    {
        return $this->gallery['modified'];
    }

    /**
     * Returns adder ID.
     *
     * @return int
     */
    public function adderID()
    {
        return (int) $this->gallery['adder_ID'];
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
        $name = trim($this->gallery['adder_first_name'].' '.$this->gallery['adder_surname']);
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
        return (int) $this->gallery['modifier_ID'];
    }

    /**
     * Returns modifier full name.
     *
     * @param string $type
     *
     * @return int
     */
    public function modifierFullName($type = '')
    {
        $name = $this->gallery['modifier_first_name'].' '.$this->gallery['modifier_surname'];
        if ('raw' === $type) {
            return $name;
        }

        return Text::escape($name);
    }

    /**
     * Checks whether the gallery has modified.
     *
     * @return bool
     */
    public function isModified()
    {
        return (bool) $this->gallery['modified'];
    }

    /**
     * Returns gallery slug.
     *
     * @param string $type
     *
     * @return string
     */
    public function slug($type = '')
    {
        $slug = $this->gallery['slug'];
        if ('raw' === $type) {
            return $slug;
        }

        return Text::escape($slug);
    }

    public function thumbsWidth()
    {
        return $this->gallery['thumb_width'];
    }

    public function thumbsHegiht()
    {
        return $this->gallery['thumb_height'];
    }

    public function code()
    {
        return '{{gallery:'.$this->id().'}}';
    }

    public function hasPhotos()
    {
        $parser = new Parser();
        $this->images = $parser->createGallery([
            'slug' => $this->slug(),
            // 'thumb_width' => $this->thumbsWidth(),
            // 'thumb_height' => $this->thumbsHegiht(),
            'thumb_width' => 100,
            'thumb_height' => 75,
        ], $onlyArray = true);

        return !empty($this->images);
    }

    public function imagesList()
    {
        return $this->images;
    }
}
