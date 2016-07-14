<?php
namespace Rudolf\Modules\Pages\One;

use Rudolf\Component\Hooks;

class Page
{
    protected $page;

    public function __construct($page = [])
    {
        $this->setData($page);
    }

    public function setData($page)
    {
        $this->page = array_merge(
            [
                'id' => 0,
                'title' => '',
                'author' => '',
                'content' => '',
                'views' => ''
            ],
            (array) $page
        );
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
