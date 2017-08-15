<?php

namespace Rudolf\Component\Feed;

/**
 * This file is part of Rudolf articles module.
 *
 * RSS2 Feed generator
 *
 * @see http://cyber.law.harvard.edu/rss/rss.html
 *
 * @author Mikołaj Pich <m.pich@outlook.com>
 *
 * @version 0.1
 */
class RSS2Item implements IRSS2Item
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $link;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $author;

    /**
     * @var string
     */
    private $category;

    /**
     * @var string
     */
    private $comments;

    /**
     * @var string
     */
    private $enclosure;

    /**
     * @var string
     */
    private $guid;

    /**
     * @var string
     */
    private $pubDate;

    /**
     * @var string
     */
    private $source;

    /**
     * Set item title.
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Set item link.
     *
     * @param string $link
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

    /**
     * Set item descritpion.
     *
     * @param string descrption
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Set item author.
     *
     * @param string $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * Set item category.
     *
     * @param string $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function setComments($comments)
    {
        $this->comments = $comments;
    }

    public function setEnclosure($enclosure)
    {
        $this->enclosure = $enclosure;
    }

    public function setGuid($guid)
    {
        $this->guid = $guid;
    }

    public function setPubDate($pubDate)
    {
        $this->pubDate = $pubDate;
    }

    public function setSource($source)
    {
        $this->source = $source;
    }

    /**
     * Get item title.
     *
     * @return bool|string
     */
    public function getTitle()
    {
        if (empty($this->title)) {
            return false;
        }

        return '<title>'.strip_tags($this->title).'</title>';
    }

    /**
     * Get item link.
     *
     * @return bool|string
     */
    public function getLink()
    {
        if (empty($this->link)) {
            return false;
        }

        return '<link>'.$this->link.'</link>';
    }

    /**
     * Get item description.
     *
     * @return bool|string
     */
    public function getDescription()
    {
        if (empty($this->description)) {
            return false;
        }

        $content = str_replace(array("\n", "\r"), '', $this->description);

        return '<description>'.htmlspecialchars($content).'</description>';
    }

    /**
     * Get item author.
     *
     * @return bool|string
     */
    public function getAuthor()
    {
        if (empty($this->author)) {
            return false;
        }

        return '<author>'.$this->author.'</author>';
    }

    /**
     * Get item category.
     *
     * @return bool|string
     */
    public function getCategory()
    {
        if (empty($this->category)) {
            return false;
        }

        return '<category>'.$this->category.'</category>';
    }

    /**
     * Get item pub date.
     *
     * @return bool|string
     */
    public function getPubDate()
    {
        if (empty($this->pubDate)) {
            return false;
        }

        return '<pubDate>'.$this->pubDate.'</pubDate>';
    }

    /**
     * Get <item> element.
     *
     * @return string
     */
    public function getItem()
    {
        $xml[] = $this->getTitle();
        $xml[] = $this->getLink();
        $xml[] = $this->getDescription();
        $xml[] = $this->getAuthor();
        $xml[] = $this->getPubDate();
        $xml[] = $this->getCategory();

        $xml = array_filter($xml);

        foreach ($xml as $key => $value) {
            $xml[$key] = "\t\t\t".$value;
        }

        array_unshift($xml, "\t\t".'<item>');

        $xml[] = "\t\t".'</item>';

        return implode("\n", array_filter($xml));
    }
}
