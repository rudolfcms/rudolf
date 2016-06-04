<?php
namespace Rudolf\Modules\Pages;

use Rudolf\Component\Hooks;

trait Traits
{

    public function title()
    {
        return $this->page['title'];
    }

    public function author()
    {
        return $this->page['author'];
    }

    public function date()
    {
        return $this->page['date'];
    }

    public function views()
    {
        return $this->page['views'];
    }

    public function content()
    {
        $content = $this->page['content'];
        $content = Hooks\Filter::apply('content_filter', $content);
        return $content;
    }
}
