<?php

namespace Rudolf\Modules\Pages\One\Admin;

use Rudolf\Component\Html\Text;
use Rudolf\Modules\Pages\One;

class Page extends One\Page
{
    private $pagesList;

    public function setPages($pagesList)
    {
        $this->pagesList = $pagesList;
    }

    public function parentID()
    {
        return $this->page['parent_id'];
    }

    public function editUrl()
    {
        return DIR.'/admin/pages/edit/'.$this->id();
    }

    public function delUrl()
    {
        return DIR.'/admin/pages/del/'.$this->id();
    }
    public function url()
    {
        if (!isset($this->pagesList)) {
            return $this->slug();
        }
        foreach ($this->pagesList as $key => $value) {
            $pages[$value['id']] = $value;
        }

        $url = $this->slug();
        $current = $pages[$this->id()];

        if (0 === $current['parent_id']) {
            return $url;
        }

        foreach ($pages as $key => $value) {
            if ($key == $current['parent_id']) {
                $url = $value['slug'].'/'.$url;
                $current = $value;
                continue;
            }

            // chyba niepotrzebne
            if (0 == $current['parent_id']) {
                break;
            }

        }

        return DIR.'/'.$url;
    }

    public function slug()
    {
        return $this->page['slug'];
    }

    public function isPublished()
    {
        return $this->page['published'];
    }

    /**
     * Returns the keywords.
     * 
     * @param string $type null|raw
     * 
     * @return string
     */
    public function keywords($type = '')
    {
        $keywords = $this->page['keywords'];
        if ('raw' === $type) {
            return $keywords;
        }

        return Text::escape($keywords);
    }

    /**
     * Returns the description.
     * 
     * @param string $type
     * 
     * @return string
     */
    public function description($type = '')
    {
        $description = $this->page['description'];
        if ('raw' === $type) {
            return $description;
        }

        return Text::escape($description);
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
        $name = trim($this->page['adder_first_name'].' '.$this->page['adder_surname']);
        if ('raw' === $type) {
            return $name;
        }

        return Text::escape($name);
    }

    /**
     * Returns modifier full name.
     * 
     * @return int
     */
    public function modifierFullName($type = '')
    {
        $name = $this->page['modifier_first_name'].' '.$this->page['modifier_surname'];
        if ('raw' === $type) {
            return $name;
        }

        return Text::escape($name);
    }

    /**
     * Checks whether the page has modified.
     * 
     * @return bool
     */
    public function isModified()
    {
        return (bool) $this->page['modified'];
    }

    /**
     * Get content for textarea.
     */
    public function textarea()
    {
        return $this->content(false, false, false, true);
    }
}
