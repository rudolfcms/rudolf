<?php

namespace Rudolf\Modules\Pages\One;

use Rudolf\Component\Hooks;
use Rudolf\Component\Html\Text;

class Page
{
    protected $page;

    public function __construct($page = [])
    {
        $this->setData($page);
    }

    public function id()
    {
        return $this->page['id'];
    }

    public function setData($page)
    {
        $this->page = array_merge(
            [
                'id' => 0,
                'title' => '',
                'author' => '',
                'content' => '',
                'views' => '',
            ],
            (array) $page
        );
    }

    public function url()
    {
        return sprintf('%1$s/%2$s',
            DIR,
            Text::escape($this->page['slug'])
        );
        return $this->page['slug'];
    }

    public function modified()
    {
        return $this->page['modified'];
    }

    public function added()
    {
        return $this->page['added'];
    }

    public function title()
    {
        return $this->page['title'];
    }

    public function author()
    {
        return $this->page['author'];
    }

    public function content()
    {
        $content = $this->page['content'];
        $content = Hooks\Filter::apply('content_filter', $content);

        return $content;
    }

    public function views()
    {
        return $this->page['views'];
    }
}
