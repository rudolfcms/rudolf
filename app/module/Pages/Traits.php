<?php
namespace Rudolf\Modules\Pages;

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
        return $this->page['content'];
    }
}
