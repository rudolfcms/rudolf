<?php
namespace Rudolf\Modules\Categories\One;

use Rudolf\Component\Hooks;
use Rudolf\Component\Html\Text;
use Rudolf\Component\Images\Image;

abstract class Category
{
    /**
     * @var array Article data
     */
    protected $category;

    /**
     * Constructor
     * 
     * @param array $category
     */
    public function __construct($category = [])
    {
        $this->setData($category);
    }

    /**
     * Set category data
     * 
     * @param array $category
     */
    public function setData($category)
    {
        $this->category = array_merge(
            [
                'id' => 0,
                'category_ID' => 0,
                'title' => '',
                'keywords' => '',
                'description' => '',
                'content' => '',
                'views' => 0,
                'slug' => '',
                'url' => '',
            ],
            (array) $category
        );
    }

    /**
     * Returns category ID
     * 
     * @return int
     */
    public function id()
    {
        return (int) $this->category['id'];
    }

    /**
     * Returns category title
     * 
     * @param string $type null|raw
     * 
     * @return string
     */
    public function title($type = '')
    {
        $title = $this->category['title'];
        if ('raw' === $type) {
            return $title;
        }

        return Text::escape($title);
    }

    /**
     * Returns the keywords
     * 
     * @param string $type null|raw
     * 
     * @return string
     */
    public function keywords($type = '')
    {
        $keywords = $this->category['keywords'];
        if ('raw' === $type) {
            return $keywords;
        }

        return Text::escape($keywords);
    }

    /**
     * Returns the description
     * 
     * @param string $type
     * 
     * @return string
     */
    public function description($type = '')
    {
        $description = $this->category['description'];
        if ('raw' === $type) {
            return $description;
        }

        return Text::escape($description);
    }
    
    /**
     * Returns content
     * 
     * @param bool|int $truncate
     * @param bool $stripTags
     * @param bool $escape
     * @param bool $raw
     * 
     * @return string
     */
    public function content($truncate = false, $stripTags = false, $escape = false, $raw = false) {
        $content = $this->category['content'];

        if (true === $stripTags) {
            $content = strip_tags($content);
        }

        if (false !== $truncate and strlen($content) > $truncate) {
            $content = Text::truncate($content, $truncate);
        }

        if (true === $escape) {
            $content = Text::escape($content);
        }

        if (false === $raw) {
            $content = Hooks\Filter::apply('content_filter', $content);
            return $content;
        }

        return $content;
    }

    /**
     * Returns date of category added
     * 
     * @return string
     */
    public function added()
    {
        return $this->category['added'];
    }

    /**
     * Returns date of last category modified
     * 
     * @return string
     */
    public function modified()
    {
        return $this->category['modified'];
    }

    /**
     * Returns adder ID
     * 
     * @return int
     */
    public function adderID()
    {
        return (int) $this->category['adder_ID'];
    }

    /**
     * Returns first name and surname of adder
     * 
     * @param string $type
     * 
     * @return string
     */
    public function adderFullName($type = '') {
        $name = trim($this->category['adder_first_name'] . ' ' . $this->category['adder_surname']);
        if ('raw' === $type) {
            return $name;
        }

        return Text::escape($name);
    }

    /**
     * Returns modifier ID
     * 
     * @return int
     */
    public function modifierID()
    {
        return (int) $this->category['modifier_ID'];
    }

    /**
     * Returns modifier full name
     * 
     * @return int
     */
    public function modifierFullName($type = '') {
        $name = $this->category['modifier_first_name'] . ' ' . $this->category['modifier_surname'];
        if ('raw' === $type) {
            return $name;
        }

        return Text::escape($name);
    }

    /**
     * Checks whether the category has modified
     * 
     * @return bool
     */
    public function isModified()
    {
        return (bool) $this->category['modified'];
    }

    /**
     * Returns the number of views
     * 
     * @return int
     */
    public function views()
    {
        return (int) $this->category['views'];
    }

    public function total()
    {
        return (int) $this->category['total'];
    }

    /**
     * Returns category slug
     * 
     * @return string
     */
    public function slug()
    {
        return Text::escape($this->category['slug']);
    }
}
